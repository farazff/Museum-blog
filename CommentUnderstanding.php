<?php


class CommentUnderstanding
{

    function AnalyzeComment($input): bool
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://api.au-syd.natural-language-understanding.watson.cloud.ibm.com/instances/905488a0-fd6c-4f59-8e60-88b5d33aaf82/v1/analyze?version=2019-07-12');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "{\n  \"text\": \" '.$input.' \",\n  \"features\": {\n      \"emotion\":{\n}\n  }\n}");
        curl_setopt($ch, CURLOPT_USERPWD, 'apikey' . ':' . 'X6E6vAUZBd07H4KWfg3GbSkBVNPlFDLSX04mk_p_JIvn');

        $headers = array();
        $headers[] = 'Content-Type: application/json';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }

        curl_close($ch);

        $resultJson = json_decode((string)$result);

        $anger = ((array_values((array)((array_values((array)(array_values((array)((array_values((array)$resultJson))[2])))[0]))[0])))[4]);
        $disgust = ((array_values((array)((array_values((array)(array_values((array)((array_values((array)$resultJson))[2])))[0]))[0])))[3]);
        $fear = ((array_values((array)((array_values((array)(array_values((array)((array_values((array)$resultJson))[2])))[0]))[0])))[2]);

        if ($anger >= 0.6 || $disgust >= 0.4 || $fear >= 0.4) {
            return false;
        } else {
            return true;
        }

    }

}