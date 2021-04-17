<?php
# includes the autoloader for libraries installed with composer
require FCPATH . 'vendor/autoload.php';
putenv('GOOGLE_APPLICATION_CREDENTIALS=./google_ocr_speach_to_text.json');
# imports the Google Cloud client library
use Google\Cloud\Vision\VisionClient;
use Google\Cloud\Vision\V1\ImageAnnotatorClient;
use Google\Cloud\Speech\V1\SpeechClient;
use Google\Cloud\Speech\V1\RecognitionAudio;
use Google\Cloud\Speech\V1\RecognitionConfig;
use Google\Cloud\Speech\V1\RecognitionConfig\AudioEncoding;
# The name of the audio file to transcribe
$audioFile = 'audio/1.wav';
# get contents of a file into a string
$content = file_get_contents($audioFile);
# set string as audio content
$audio = (new RecognitionAudio())
   ->setContent($content);
# The audio file's encoding, sample rate and language
$config = new RecognitionConfig([
   'encoding' => AudioEncoding::LINEAR16,
   'sample_rate_hertz' => 48000,
   'language_code' => 'ja-JP'
]);
# Instantiates a client
$client = new SpeechClient();
# Detects speech in the audio file
$response = $client->recognize($config, $audio);
# Print most likely transcription
foreach ($response->getResults() as $result) {
    print_r($result);
}
$client->close();