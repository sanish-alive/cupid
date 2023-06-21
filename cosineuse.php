<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'localhost:5000/cosine',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => 'lastname=shrestha&age=21&height=181&gender=Female&bio=i%20am%20a%20software%20engineer%20with%20a%20passion%20for%20coding',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/x-www-form-urlencoded'
  ),
));

$response = curl_exec($curl);

curl_close($curl);

// Decode the response JSON
$data = json_decode($response, true);

// Check if the decoding was successful
if ($data !== null) {
    // Loop through the array elements
    foreach ($data as $item) {
      if(!isset($item['age'])) continue;
      // Check if the key exists before accessing its value
      echo "First Name: " . (isset($item['firstname']) ? $item['firstname'] : "") . PHP_EOL;
      echo "Last Name: " . (isset($item['lastname']) ? $item['lastname'] : "") . PHP_EOL;
      echo "Age: " . (isset($item['age']) ? $item['age'] : "") . PHP_EOL;
      echo "Email: " . (isset($item['email']) ? $item['email'] : "") . PHP_EOL;
      echo "Bio: " . (isset($item['bio']) ? $item['bio'] : "") . PHP_EOL;
      echo "Cosine: " . (isset($item['cosine']) ? $item['cosine'] : "") . PHP_EOL;
      echo "Gender: " . (isset($item['gender']) ? $item['gender'] : "") . PHP_EOL;
      echo "ID: " . (isset($item['id']) ? $item['id'] : "") . PHP_EOL;
      echo PHP_EOL;
      echo '<br>';
    }
} else {
    echo "Error decoding JSON response." . PHP_EOL;
}

?>