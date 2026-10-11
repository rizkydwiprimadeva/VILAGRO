from flask import Flask, request, jsonify
from ultralytics import YOLO
import os
import uuid
from flask_cors import CORS

app = Flask(__name__)
CORS(app)

MODEL_PATH = os.path.join(os.path.dirname(__file__), "models", "best.pt")
model = YOLO(MODEL_PATH)

# Sesuai urutan class di args.yaml Anda
CLASS_NAMES = ['rotten_stalk', 'blight', 'downy_mildew']

OUTPUT_DIR = os.path.join(os.path.dirname(__file__), "..", "public", "results")
os.makedirs(OUTPUT_DIR, exist_ok=True)

@app.route('/health', methods=['GET'])
def health():
    return jsonify({"status": "ok", "classes": CLASS_NAMES})

@app.route('/predict', methods=['POST'])
def predict():
    if 'image' not in request.files:
        return jsonify({"error": "No image uploaded"}), 400

    file = request.files['image']
    conf = float(request.form.get('conf', 0.25))

    filename = f"detect_{uuid.uuid4().hex}.jpg"
    temp_path = os.path.join(OUTPUT_DIR, filename)
    file.save(temp_path)

    results = model.predict(
        source=temp_path,
        conf=conf,
        save=True,
        project=OUTPUT_DIR,
        name="predict",
        exist_ok=True,
    )

    # YOLO menyimpan hasil di OUTPUT_DIR/predict/{filename}
    result_img = os.path.join("predict", filename)

    detections = []
    for r in results:
        for box in r.boxes:
            cid = int(box.cls[0])

            if cid >= len(CLASS_NAMES):
                continue

            detections.append({
                "class_id": cid,
                "class_name": CLASS_NAMES[cid] if cid < len(CLASS_NAMES) else "unknown",
                "confidence": round(float(box.conf[0]), 4),
                "bbox": [round(float(x), 2) for x in box.xyxy[0].tolist()],
            })

    return jsonify({
        "success": True,
        "image_result": f"/results/{result_img}",
        "detections": detections,
        "total": len(detections),
    })

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5001, debug=False)