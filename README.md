# AI-Based Camera Website

This repository contains the source code for an AI-based camera website, developed as part of the **CircuitTech Project** at **NIIT University**. The project leverages advanced AI technologies to deliver real-time camera analysis, enhanced security features, and an interactive dashboard for live data visualization and insights.

## Table of Contents

- [Features](#features)
- [Technologies Used](#technologies-used)
- [Installation](#installation)
- [Usage](#usage)
- [Project Structure](#project-structure)
- [Future Enhancements](#future-enhancements)
- [Contributing](#contributing)
- [License](#license)

## Features

1. **AI-Powered Analysis**
   - Real-time object detection and recognition using AI models.
   - Integrated with the **Cloud Vision API** for advanced analytics.

2. **Enhanced Security**
   - AI-driven motion detection and alert systems.
   - Customizable security settings for monitoring sensitive areas.

3. **Analysis Dashboard**
   - Live camera feed with overlays for detected objects and events.
   - Data visualization tools to analyze patterns and generate insights.

## Technologies Used

- **Frontend**: HTML, CSS, JavaScript (with modern frameworks for interactivity).
- **Backend**: Node.js, Express.js.
- **AI Integration**: Google Cloud Vision API.
- **Database**: MongoDB (for storing analysis data).
- **Deployment**: Docker, AWS.

## Installation

1. Clone the repository:

   ```bash
   git clone https://github.com/your-username/ai-camera-website.git
   ```

2. Navigate to the project directory:

   ```bash
   cd ai-camera-website
   ```

3. Install dependencies:

   ```bash
   npm install
   ```

4. Set up environment variables:

   Create a `.env` file in the root directory with the following details:

   ```
   CLOUD_VISION_API_KEY=your-google-cloud-api-key
   MONGO_URI=your-mongodb-connection-string
   ```

5. Start the development server:

   ```bash
   npm start
   ```

6. Open your browser and visit `http://localhost:3000`.

## Usage

1. **Live Camera Demo**:
   - Access the live feed through the dashboard.
   - Watch real-time AI-powered object detection in action.

2. **Analysis Dashboard**:
   - Visualize security and analytics data.
   - Monitor activity logs and detected events.

3. **Custom Alerts**:
   - Configure and test motion detection alerts.

## Project Structure

```
ai-camera-website/
├── public/
│   ├── css/
│   ├── js/
│   ├── images/
├── src/
│   ├── controllers/
│   ├── models/
│   ├── routes/
│   └── views/
├── .env
├── package.json
├── server.js
└── README.md
```

## Future Enhancements

- Add support for multiple camera feeds.
- Integrate additional AI models for specialized use cases (e.g., facial recognition).
- Implement a mobile app for remote monitoring.
- Enhance scalability for large-scale deployments.

## Contributing

Contributions are welcome! Follow these steps to contribute:

1. Fork the repository.
2. Create a new branch:

   ```bash
   git checkout -b feature-name
   ```

3. Commit your changes:

   ```bash
   git commit -m "Description of changes"
   ```

4. Push to the branch:

   ```bash
   git push origin feature-name
   ```

5. Submit a pull request.

## License

This project is licensed under the [MIT License](LICENSE).

---

We hope this project inspires innovation in AI-powered security solutions. Feel free to reach out for collaborations or queries!
