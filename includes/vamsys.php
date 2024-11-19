<?php 
    
    class vamsys{
        protected   $env        = NULL,  
                    $apiUri     = "https://vamsys.io/",
                    $jsonData   = "",
                    $jsonFile   = "",
                    $jsonKey    = "",
                    $apiKey     = "";

        public function leaderboard(){
            $this->jsonData = self::JsonRequest('leaderboard/');
            if(!empty($this->jsonData)){
                return $this->jsonData;
            }
        }

        public function statistics()
        {
           /*  $this->jsonData = self::JsonRequest('statistics/');
            if(!empty($this->jsonData)){
                return $this->jsonData;
            } */
            
            return self::reqeustApiCall('airline/statistics');
        }
        

        public function activeFlights()
        {
            return self::reqeustApiCall('airline/active-flights');
        }

        public function map()
        {   
            $this->jsonData = self::JsonRequest('statistics/map/');
            if(!empty($this->jsonData)){
                return $this->jsonData;
            }
        }
        

        /* 
            Get metar information from :
                airport_code
                date_time
        */
        public function metar($dataArray = []){
            return self::reqeustApiCall("metar", $dataArray);
        }

        public function events(){
            return self::reqeustApiCall("events");
        }
        /* 
            Get aircraft information from :
                aircraft_id
                booking_id
                aircraft_registration
        */
        public function aircraft($dataArray = []){
            return self::reqeustApiCall("aircraft/find", $dataArray);
        }

        //get pilot data
        public function pilot($data){
            if($data){
                return self::reqeustApiCall("pilot", ["discord_member_id" => "{$data}"]);
            }
        }

        //get airline info
        public function airline(){
            return self::reqeustApiCall('airline');
        }

        /* 
            find airport based on :
                airport_code  
                airport_id
                booking_id
        */
        public function findAirport($dataArray = []){
            if(!empty($dataArray)){
                return self::reqeustApiCall('airport/find', $dataArray);
            }
        }

        //this is for fecht date of the api calls 
        protected function reqeustApiCall($methode = null, $dataArray = []){
            // Set the headers
            $headers = [
                'Authorization: Bearer '.$this->apiKey,
                'Accept: application/json'
            ];
           
            // Initialize cURL session
            $ch = curl_init($this->apiUri."api/token/v1/discord/".$methode);

            // Set cURL options
            curl_setopt($ch, CURLOPT_POST, true); // Set request method to POST
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the response as a string
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); // Set the headers
            if($dataArray){
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS,  http_build_query($dataArray));
            }
            
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Bypass SSL verification if necessary

             // Execute the request and get the response
            $response = curl_exec($ch);
            
            // Check for errors
            if (curl_errno($ch)) {
                return 'Error: ' . curl_error($ch);
            } else {
                // Get HTTP status code
                $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                if ($httpCode == 200) {
                    // Print the response data
                    return json_decode($response, TRUE);
                } else {
                    // Print the error code if the request failed
                    return  'Error: HTTP Status Code ' . $httpCode;
                }
            }

            // Close the cURL session
            curl_close($ch);
        }


        //this is only for fetshing data from the json files!!
        //wil later be update for the holle system 
        protected function JsonRequest($methode = null)
        {
            $curl = curl_init(); 
            curl_setopt($curl,  CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl,  CURLOPT_URL, $this->apiUri.$methode.$this->jsonKey);
            curl_setopt($curl,  CURLOPT_RETURNTRANSFER, true);
            
            $head       = curl_exec($curl);
            $httpCode   = curl_getinfo($curl, CURLINFO_HTTP_CODE);    
            $data       = json_decode($head, true);
            
            curl_close($curl);
                        
            return $data;
        }
    }
