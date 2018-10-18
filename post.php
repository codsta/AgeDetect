<?php

if($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_FILES["pic"]))
{
  $uploadfile=$_FILES["pic"]["tmp_name"];
  $folder="uploads/";
  move_uploaded_file($_FILES["pic"]["tmp_name"], $folder.$_FILES["pic"]["name"]);
  $filename = $_FILES["pic"]["name"];
  $url1= 'http://localhost/AgeDetect/uploads/'.$filename;
  // Replace <Subscription Key> with a valid subscription key.
  $ocpApimSubscriptionKey = 'xxxxxxxxxxxxxxxxxxxxxxxxxx';
  // You must use the same location in your REST call as you used to obtain
  // your subscription keys. For example, if you obtained your subscription keys
  // from westus, replace "westcentralus" in the URL below with "westus".
  $uriBase = 'https://westcentralus.api.cognitive.microsoft.com/face/v1.0/';
  // This sample uses the PHP5 HTTP_Request2 package
  // (http://pear.php.net/package/HTTP_Request2).
  require_once 'HTTP/Request2.php';
  $request = new Http_Request2($uriBase . '/detect');
  $url = $request->getUrl();

  $headers = array(
      // Request headers
      'Content-Type' => 'application/octet-stream',
      'Ocp-Apim-Subscription-Key' => $ocpApimSubscriptionKey
  );
  $request->setHeader($headers);

  $parameters = array(
      // Request parameters
      'returnFaceId' => 'true',
      'returnFaceLandmarks' => 'false',
      'returnFaceAttributes' => 'age,gender,headPose,smile,facialHair,glasses,' .
          'emotion,hair,makeup,occlusion,accessories,blur,exposure,noise');
  $url->setQueryVariables($parameters);
  $request->setMethod(HTTP_Request2::METHOD_POST);
  // Request body parameters
  // $body = json_encode(array('url' => $imageUrl));
  $img = 'uploads/'.$filename;
  $fp = fopen($img , 'rb');
  $body = $fp;
  // Request body
  $request->setBody($body);
  try
  {
      $response = $request->send();
      // echo "<pre>" .json_encode(json_decode($response->getBody()), JSON_PRETTY_PRINT) . "</pre>";
      $result = json_decode($response->getBody());
      $gender =  $result[0]->faceAttributes->gender;
      $age = $result[0]->faceAttributes->age;

      $arr = [ $gender  ,$age  , $url1];

      echo json_encode($arr);

  }
  catch (HttpException $ex)
  {
      echo "<pre>" . $ex . "</pre>";
  }

}

?>
