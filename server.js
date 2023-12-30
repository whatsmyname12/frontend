const express = require('express');
const bodyParser = require('body-parser');
const app = express();

app.use(bodyParser.urlencoded({ extended: true }));

app.post('/process-login', (req, res) => {
    // Your PHP script logic here
    // Example: Log the form data to the console
    console.log(req.body);

    // Send a response
    res.send('Form data received!');
});

const PORT = process.env.PORT || 3000;
app.listen(PORT, () => {
    console.log(`Server is running on http://localhost:${PORT}/`);
});
