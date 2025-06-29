<?php
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Contact Us</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #f4f4f4;
      margin: 0;
      padding: 0;
      display: flex;
      height: 100vh;
      align-items: center;
      justify-content: center;
    }

    .contact-form {
      background: white;
      padding: 30px 40px;
      border-radius: 15px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 500px;
    }

    .contact-form h2 {
      margin-bottom: 20px;
      color: #333;
      text-align: center;
    }

    .contact-form input,
    .contact-form textarea {
      width: 100%;
      padding: 12px 15px;
      margin: 10px 0;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 16px;
      transition: 0.3s ease;
    }

    .contact-form input:focus,
    .contact-form textarea:focus {
      border-color: #007bff;
      outline: none;
    }

    .contact-form button {
      width: 100%;
      padding: 12px;
      background: #007bff;
      color: white;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    .contact-form button:hover {
      background: #0056b3;
    }
  </style>
</head>
<body>

  <form class="contact-form" onsubmit="handleSubmit(event)">
    <h2>Contact Us</h2>
    <input type="text" id="name" placeholder="Your Name" required>
    <input type="email" id="email" placeholder="Your Email" required>
    <input type="text" id="subject" placeholder="Subject" required>
    <textarea id="message" rows="5" placeholder="Your Message" required></textarea>
    <button type="submit">Send Message</button>
  </form>

  <script>
    function handleSubmit(event) {
      event.preventDefault();
      const name = document.getElementById('name').value;
      const email = document.getElementById('email').value;
      const subject = document.getElementById('subject').value;
      const message = document.getElementById('message').value;

      console.log("Name:", name);
      console.log("Email:", email);
      console.log("Subject:", subject);
      console.log("Message:", message);

      alert("Form submitted! Check the console for details.");
    }
  </script>

</body>
</html>
?>