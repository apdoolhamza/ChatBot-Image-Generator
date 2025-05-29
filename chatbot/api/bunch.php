<?php
// conversation API function
function conversation($message, $apiKey) {    
    $url = 'https://api-inference.huggingface.co/models/google/gemma-2-2b-it/v1/chat/completions';
        
    $data = [
    "model" => "google/gemma-2-2b-it",
    "messages" => [
    [
    "role" => "user",
    "content" => $message
    ]
    ],
    "max_tokens" => 500
    ];
    
    $headers = [
    "Authorization: Bearer $apiKey",
    "Content-Type: application/json"
    ];
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    
    $response = curl_exec($ch);
    if (curl_errno($ch)) {
    return 'Hmm... someting seems to have gone wrong.';
    }
    curl_close($ch);

    // Decode JSON string into a PHP associative array
    $data = json_decode($response, true);

    // Access the 'content' field
    $content = $data['choices'][0]['message']['content'];
    return $content;
   }

   
//    Create image API function
    function generateImage($message, $apiKey) {
        $url = "https://api-inference.huggingface.co/models/stabilityai/stable-diffusion-3.5-large-turbo";
        $api_token = "$apiKey";
        $data = json_encode(array("inputs" => "$message"));
        
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Authorization: Bearer ' . $api_token
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        $response = curl_exec($ch);
        
        if (curl_errno($ch)) {
            return "Hmm... someting seems to have gone wrong.";
            exit;
        }
        
        curl_close($ch);
        
        // Delete images older than 30 minutes
        $image_files = glob('../generated_imgs/generated_image_*.png');
        $now = time();
        $max_age = 1200;

        foreach ($image_files as $file) {
            if (filemtime($file) < $now - $max_age) {
                unlink($file);
            }
        }

        // Generate a unique filename
        $file_name = 'generated_image_' . time() . '.png'; // Example: generated_image_1698765432.png
        $file_path = '../generated_imgs/' . $file_name;
        if (file_put_contents($file_path, $response) === false) {
            echo "Failed to save the image to: " . $file_path;
        } else {
            echo "<p class='mb-3'><a class='btn p-2' style='font-size:14px;border-radius:15px 15px 0 15px;background-color:#00000020;border:1px solid #00000020;display:block !important;' href='generated_imgs/$file_name' download>Download <svg class='bi pe-none mb-1' width='17' height='17'><use xlink:href='#downloadIcon'/></svg></a></p>";

            echo "<img id='generatedImg' src='generated_imgs/$file_name'>";
        }
}
?>