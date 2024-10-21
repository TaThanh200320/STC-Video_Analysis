import express from 'express';
import { createServer } from 'http';
import WebSocket from 'ws';
import rtspRelay from 'rtsp-relay';

const app = express();
const server = createServer(app);
const wss = new WebSocket.Server({ server });

const { proxy } = rtspRelay(app);

wss.on('connection', (ws, req) => {
  const cameraId = req.url.split('/').pop();
  const cameraUrl = getCameraUrlById(cameraId);
  
  if (cameraUrl) {
    proxy({
      url: cameraUrl,
      verbose: true,
      transport: 'tcp'
    })(ws);
  } else {
    ws.close();
  }
});

function getCameraUrlById(id) {
  // Giả lập lấy URL camera, trong thực tế sẽ truy vấn từ database
  const cameras = {
    1: 'rtsp://admin:Admin123456*@@192.168.8.191:554/Streaming/channels/101',
    2: 'rtsp://admin:Admin123456*@@192.168.8.193:554/Streaming/channels/101',
    3: 'rtsp://admin:Stc@vielina.com@192.168.8.192:554/cam/realmonitor?channel=1&subtype=0',
  };
  return cameras[id];
}

server.listen(3000, () => {
  console.log('RTSP Relay Server is running on port 3000');
});