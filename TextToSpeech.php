<?php


class TextToSpeech
{

    function CreateSpeechFile($text, $fileName)
    {
        $url = "https://api.au-syd.text-to-speech.watson.cloud.ibm.com/instances/c90469bb-1e24-40e2-857c-02e2033e64a6/v1/synthesize";

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $headers = array(
            "Content-Type: application/json",
            "Accept: audio/wav",
            "Authorization: Basic YXBpa2V5Om1kckpUTnNQcm9xREM1dmE3ZHhEcktNcllVM25lVWJqUnI5ZnJzd0dpN09L",
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        $data = '{"text":"'.$text.'"}';

        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);


        $resp = curl_exec($curl);
        curl_close($curl);

        $file = fopen($fileName . '.mp3', "w") or die("unable");
        $txt = $resp;
        fwrite($file, $txt);
        fclose($file);
    }

}