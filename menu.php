<?php
// DB credentials.
//include '../config.php';

include_once 'util.php';
	require_once('sms.php');
	
	  $livesms = new SMS();
class Menu
{
    protected $text;
    protected $sessionId;


    function __construct()
    {
    }



    public function mainMenuRegistered($phoneNumber)
    {
        //shows initial user menu for registered users
        include 'dbconnect.php';            
            $user = "SELECT * FROM users WHERE phone='$phoneNumber' ";
            $result2 = $conn->query($user);
            if ($result2->num_rows > 0) {
                while($row2 = $result2->fetch_assoc()) {
                    $name = $row2["fullname"];
                }
        $response = "Welcome " . $name . " Reply with\n";
        $response .= "1. Send Money\n";
        $response .= "2. Check Balance\n";
        $response .= "3. Fertilizer Info.\n";
        $response .= "4. Crop Info.\n";
        $response .= "5. Info on loans & grants\n";
        $response .= "6. Weather Info.\n";
        $response .= "7. Market Price\n";
        $response .= "8. Change Pin\n";
        $response .= "9. Customer Care\n";
        return $response;
            } else {
                 echo "CON hello".mainMenuUnRegistered($phoneNumber);
            }
           
    }
    
    
    
    
    public function mainMenuUnRegistered($phoneNumber)
    {
        //shows initial user menu for unregistered users
        $response = "CON Welcome. Reply with\n";
        $response .= "1. Register\n";
        echo $response;
    }
    
    
    
    
    
    
        public function Fertilizer($textArray,$phoneNumber)
    {
        $level = count($textArray);
        $response = "";
        
        if($level == 1){
            $response .="CON Reply With:\n";
            $response .="1. Nitrogen-based Fertilizers\n";
            $response .="2. Phosphorus-based Fertilizers\n";
            echo $response;
        }elseif($level == 2 && $textArray[1] == "1"){
            echo "END Thanks, you will receive an SMS shortly";
        }elseif($level == 2 && $textArray[1] == "2"){
            echo "END Thanks, you will receive an SMS shortly";
        }
    }
    
    
    
    
    
    
        public function Crop($textArray,$phoneNumber)
    {
        $level = count($textArray);
        $response = "";
        
        if($level == 1){
            $response .="CON Reply With:\n";
            $response .="1. Rice\n";
            $response .="2. Maize\n";
            $response .="3. Wheat\n";
            $response .="3. Beans\n";
            $response .="3. Yam\n";
            echo $response;
        }elseif($level == 2){
            echo "END Thanks, you will receive an SMS shortly";
        }
    }
    
    
    
    
        public function CustomerCare($textArray,$phoneNumber)
    {
        $level = count($textArray);
        $response = "";
        
        if($level == 1){
           echo "END For assistance, call our customer support at 14542876 or send an SMS to +2348114528984";
        }
    }
    
    
    
    
    
    
    
        public function Market($textArray,$phoneNumber)
    {
        $level = count($textArray);
        $response = "";
        
        if($level == 1){
            $response .="CON Reply With:\n";
            $response .="1. Rice\n";
            $response .="2. Maize\n";
            $response .="3. Wheat\n";
            $response .="4. Beans\n";
            $response .="5. Yam\n";
            echo $response;
        }elseif($level == 2 && $textArray[1] == 1){
            echo "END Current price for Rice: 2,502 ₦  per Mudu";
        }elseif($level == 2 && $textArray[1] == 2){
            echo "END Current price for Maize: 1,502 ₦  per kg";
        }elseif($level == 2 && $textArray[1] == 3){
            echo "END Current price for wheat:  ₦1980  per Mudu";
        }elseif($level == 2 && $textArray[1] == 4){
            echo "END Current price for Beans:₦900  per Mudu";
        }elseif($level == 2 && $textArray[1] == 5){
            echo "END Current price for Yam: ₦3400  per kg";
        }
    }
    
    
    
    
        public function Info($textArray, $phoneNumber)
    {
        $level = count($textArray);
        $response = "";

        if ($level == 1) {
            $response .= "CON Reply With:\n";
            $response .= "1. Agriculture Equipment Loan\n";
            $response .= "2. Crop Production Loan\n";
            $response .= "3. Environmental Sustainability Grant\n";
            $response .= "4. Government Agricultural Grant\n";
            echo $response;
        } elseif ($level == 2) {
            $selectedOption = $textArray[1];

            switch ($selectedOption) {
                case '1':
                    $smsContent = "Option 1: Agriculture Equipment Loan\n"
                        . "Details: Provide financing for the purchase of agricultural equipment such as tractors, plows, and harvesters.";
              
       
            @$result = $livesms->send($phoneNumber, $smsContent);
                    echo "END Thanks, you will receive an SMS shortly";
                    break;

                case '2':
                    $smsContent = "Option 2: Crop Production Loan\n"
                        . "Details: Support for crop cultivation activities, including purchase of seeds, fertilizers, and other inputs.";
                    $this->sendSMS($phoneNumber, $smsContent);
                    echo "END Thanks, you will receive an SMS shortly";
                    break;

                case '3':
                    // Content for Environmental Sustainability Grant (customize as needed)
                    $smsContent = "Option 3: Environmental Sustainability Grant\n"
                        . "Details: Grant to support environmentally friendly farming practices and sustainability initiatives.";
                    $this->sendSMS($phoneNumber, $smsContent);
                    echo "END Thanks, you will receive an SMS shortly";
                    break;

                case '4':
                    // Content for Government Agricultural Grant (customize as needed)
                    $smsContent = "Option 4: Government Agricultural Grant\n"
                        . "Details: Grant provided by the government to support various agricultural development projects.";
                    $this->sendSMS($phoneNumber, $smsContent);
                    echo "END Thanks, you will receive an SMS shortly";
                    break;

                default:
                    echo "END Invalid selection. Please try again.";
                    break;
            }
        }
    }



    
    
    
    
    
    
        public function Weather($textArray,$phoneNumber)
    {
        $level = count($textArray);
        $response = "";
        
        if($level == 1){
            echo "CON Enter your location";
        }elseif($level == 2){
            $data="$textArray[1]";
            $curl = curl_init();
            // $encode=json_encode($data);
            curl_setopt_array($curl, [
              CURLOPT_URL => "https://weather.visualcrossing.com/VisualCrossingWebServices/rest/services/timeline/$data?unitGroup=metric&key=Z3Q4589SR5VTVZHHXWHV3JLXQ&contentType=json",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_SSL_VERIFYPEER => false,
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "GET",
            //   CURLOPT_POSTFIELDS => $data,
              CURLOPT_HTTPHEADER => [
                "accept: application/json",
                "Content-Type: application/x-www-form-urlencoded"
              ],
            ]);
            
            $response = curl_exec($curl);
            $err = curl_error($curl);
            
            curl_close($curl);
            
            if ($err) {
              echo "END cURL Error #:" . $err;
            } else {
                $resp = json_decode($response,true);
            //  var_dump ($resp);
            // echo $response;
              
              
            //  $cast = $resp['forecast']['narrative_512char'];
             $con = $resp['days'][0]['conditions'];
             $temp = $resp['days'][0]['temp'];
             echo "END The Wheather for $data is $temp \n $con";
        }
    }
    }
    
    
    
    
    
    
    public function registerMenu($textArray, $phoneNumber)
    {
        $level = count($textArray);
        if($level == 1){
            echo "CON Enter your fullname";
        }elseif($level == 2){
            echo "CON Enter pin";
        }elseif($level == 3){
            echo "CON Re-enter pin";
        }elseif($level == 4){
            $fullname = $textArray[1];
            $pin = $textArray[2];
            $pin2 = $textArray[3];
            $date = time();
            if($pin !== $pin2){
                echo "END Pins do not match";
            }else{
                include 'dbconnect.php';
                $insert = mysqli_query($conn, "INSERT INTO users (fullname,phone,pin,bal,date_reg,language)VALUES('$fullname','$phoneNumber','$pin','0','1','$date')");
                if($insert == true){
                    echo "END Registration successful";
                }else{
                    echo "END Registration not successful";
                }
            }
        }
    }
    
    
    public function checkBalanceMenu($textArray, $phoneNumber)
    {
        $level = count($textArray);
        if($level == 1){
            echo "CON Enter your pin";
        }elseif($level == 2){
            $oldpin = $textArray[1];
            include 'dbconnect.php';
            $user = "SELECT * FROM users WHERE phone='$phoneNumber' ";
            $result2 = $conn->query($user);
            if ($result2->num_rows > 0) {
                while($row2 = $result2->fetch_assoc()) {
                    $pin = $row2["pin"];
                    $bal = $row2["bal"];
                }
                
                if($pin !== $oldpin){
                    echo "END Incorrect pin";
                }else{
                    echo "END Your balance is NGN ".number_format($bal)."";
                }
            }
                
        }
    }
    
    
    
    
    
    public function sendMoneyMenu($textArray, $phoneNumber)
    {
        include 'dbconnect.php';            
            $user = "SELECT * FROM users WHERE phone='$phoneNumber' ";
            $result2 = $conn->query($user);
            if ($result2->num_rows > 0) {
                while($row2 = $result2->fetch_assoc()) {
                    $Name = $row2["fullname"];
                    $language = $row2['language'];
                }
        //building menu for user registration 
        $level = count($textArray);
        $receiverName = "";
        $receiverMobileWithCountryCode = "";
        $response = "";
        if ($level == 1 AND $language == 1) {
                include 'dbconnect.php';
                $query1 = "SELECT * FROM users WHERE phone='$phoneNumber'";
                $result1 = mysqli_query($conn, $query1) or die(mysqli_error($conn));
                $count1 = mysqli_num_rows($result1);
                if ($count1 == 0) {
                echo "END This number has not been registered";
                } else
            echo "CON Enter mobile number of the receiver:";
        } else if ($level == 1 AND $language == 2) {
            echo "CON Saka Lambar Wayar Mai Karba:";
        }else if ($level == 1 AND $language == 3) {
            echo "CON Tẹ nọmba olugba sii:";
        }else if ($level == 1 AND $language == 4) {
            echo "CON Tinye nọmba ekwentị mkpanaaka nke nnata:";
        }else if ($level == 2 AND $language == 1) {
            echo "CON Enter amount:";
        }else if ($level == 2 AND $language == 2) {
            echo "CON Nawa Zaha Tura:";
        }else if ($level == 2 AND $language == 3) {
            echo "CON Tẹ iye sii:";
        }else if ($level == 2 AND $language == 4) {
            echo "CON Tinye ego:";
        }else if ($level == 3 AND $language == 1) {
            $response .="CON Select Bank:\n";
            $response .="1. AgriConnect\n";
            $response .="2. First Bank\n";
            $response .="3. Access Bank\n";
            $response .="4. UBA Bank\n";
            $response .="5. Zenith Bank \n";
            echo $response;
        }else if ($level == 3 AND $language == 2) {
            $response .="CON Zabi banki:\n";
            $response .="1. AgriConnect\n";
            $response .="2. First Bank\n";
            $response .="3. Access Bank\n";
            $response .="4. UBA Bank\n";
            $response .="5. Zenith Bank \n";
            echo $response;
        }else if ($level == 3 AND $language == 3) {
            $response .="CON Yan Bank:\n";
            $response .="1. AgriConnect\n";
            $response .="2. First Bank\n";
            $response .="3. Access Bank\n";
            $response .="4. UBA Bank\n";
            $response .="5. Zenith Bank \n";
            echo $response;
        }else if ($level == 3 AND $language == 4) {
            $response .="CON Họrọ ụlọ akụ:\n";
            $response .="1. AgriConnect\n";
            $response .="2. First Bank\n";
            $response .="3. Access Bank\n";
            $response .="4. UBA Bank\n";
            $response .="5. Zenith Bank \n";
            echo $response;
        } else if ($level == 4 && $textArray[3] == 1 AND $language == 1 ) {
            echo "CON Enter your PIN:";
        } else if ($level == 4 && $textArray[3] == 1 AND $language == 2 ) {
            echo "CON Saka Mukulin Sirrin Ka:";
        } else if ($level == 4 && $textArray[3] == 1 AND $language == 3 ) {
            echo "CON Te pinni re :";
        } else if ($level == 4 && $textArray[3] == 1 AND $language == 4 ) {
            echo "CON Tinye ntụtụ gị :";
        } else if ($level == 4 && $textArray[3] != 1 AND $language == 1) {
            echo "END Inter Bank transfer is yet to be implimented:";
        } else if ($level == 4 && $textArray[3] != 1 AND $language == 2) {
            echo "END Muna Aiki Akan Wannan Tsarin:";
        } else if ($level == 4 && $textArray[3] != 1 AND $language == 3) {
            echo "END A n ṣiṣẹ lori rẹ:";
        } else if ($level == 4 && $textArray[3] != 1 AND $language == 4) {
            echo "END Anyị na-arụ ọrụ na ya:";
        } else if ($level == 5) {
            $receiverMobile = $textArray[1];
            $receiverMobile=ltrim($receiverMobile, "+2340");
            $receiverMobile="+234".$receiverMobile;
            
            $receiverMobileWithCountryCode = $receiverMobile;
            
            include 'dbconnect.php';            
            $user = "SELECT * FROM users WHERE phone='$receiverMobileWithCountryCode' ";
            $result2 = $conn->query($user);
            if ($result2->num_rows > 0) {
                while($row2 = $result2->fetch_assoc()) {
                    $recieverName = $row2["fullname"];
                    $balance = $row2["bal"];
                    
                }
           if  ($language == 1){
            $response .= "You are about to send " . $textArray[2] . " to " . $recieverName . "\n";
            $response .= "1. Confirm\n";
            $response .= "2. Cancel\n";
            $response .= Util::$GO_BACK . " Back\n";
            $response .= Util::$GO_TO_MAIN_MENU .  " Main menu\n";
            echo "CON " . $response;
           } else if ($language == 2){
              $response .= "Zaha Tura " . $textArray[2] . " Zuwa " . $recieverName . "\n";
            $response .= "1. Tabbatar\n";
            $response .= "2. Soke\n";
            $response .= Util::$GO_BACK . " Back\n";
            $response .= Util::$GO_TO_MAIN_MENU .  " Main menu\n";
            echo "CON " . $response; 
           } else if ($language == 3){
              $response .= "O ti fẹ fi " . $textArray[2] . " ranṣẹ si " . $recieverName . "\n";
            $response .= "1. Jẹrisi\n";
            $response .= "2. fagilee\n";
            $response .= Util::$GO_BACK . " Back\n";
            $response .= Util::$GO_TO_MAIN_MENU .  " Main menu\n";
            echo "CON " . $response; 
           } else if ($language == 4){
              $response .= "Ị na-achọ iziga " . $textArray[2] . " Iji " . $recieverName . "\n";
            $response .= "1. Gosi\n";
            $response .= "2. Kagbuo\n";
            $response .= Util::$GO_BACK . " Back\n";
            $response .= Util::$GO_TO_MAIN_MENU .  " Main menu\n";
            echo "CON " . $response; 
           }
            }else{
                echo "END The Reciever's phone Number is not Registered";
            }
            
        } else if ($level == 6 && $textArray[5] == 1) {
            //a confirm
            //send the money plus
            //check if PIN correct
            //If you have enough funds including charges etc..
            $pin = $textArray[4];
            $amount = $textArray[2];
            // echo "END proceed";
            //connect to DB
            include 'dbconnect.php';
            $sender = "SELECT * FROM users WHERE phone='$phoneNumber' AND pin='$pin' ";
            $result2 = $conn->query($sender);
            if ($result2->num_rows > 0) {
                while($row2 = $result2->fetch_assoc()) {
                    $MyBalance = $row2["bal"];
                }
            }else{
                $amount = 0;
                echo "END incorrect pin ";
            }
                if($amount > $MyBalance AND $language == 1 ){
                    echo "END Insufficient Fund";
                }else if($amount > $MyBalance AND $language == 2 ){
                    echo "END Kudin Ka Basu Kai Ba";
                }else if($amount > $MyBalance AND $language == 3 ){
                    echo "END ko si owo to";
                }else if($amount > $MyBalance AND $language == 4 ){
                    echo "END ego ezughi oke";
                }else{
                    $receiverMobile = $textArray[1];
                    $receiverMobile=ltrim($receiverMobile, "+2340");
                    $receiverMobile="+234".$receiverMobile;
                    
                    $receiverMobileWithCountryCode = $receiverMobile;
            
            include 'dbconnect.php';            
            $user = "SELECT * FROM users WHERE phone='$receiverMobileWithCountryCode' ";
            $result2 = $conn->query($user);
            if ($result2->num_rows > 0) {
                while($row2 = $result2->fetch_assoc()) {
                    $recieverName = $row2["fullname"];
                    $balance = $row2["bal"];
                    
                }
            }
                    $newSenderBalance = $MyBalance - $amount;
                    $newRecieverBalance = $balance + $amount;
                    $thedate = time();
                    
                    $prefix = "TXN"; // Prefix for the transaction ID
                    $random_number = mt_rand(100000, 999999); // Generating a random 6-digit number
                    $timestamp = time(); // Getting the current timestamp
                    $refid = $prefix . "_" . $timestamp . "_" . $random_number;
                    
                    // $Reciever = $_SESSION['RecieverNumber'];
                    
                $update = $conn->query("UPDATE users SET bal='$newSenderBalance' WHERE phone='$phoneNumber' ");
                $update2 = $conn->query("UPDATE users SET bal='$newRecieverBalance' WHERE phone='$receiverMobileWithCountryCode' ");
                $save = $conn->query("INSERT INTO transaction (sender,receiver,amount,ref,trans_date) VALUES ('" . $phoneNumber . "','" . $receiverMobileWithCountryCode . "','" . $amount . "','" . $refid . "','" . $thedate . "')");
                
                
                
                if ($update === TRUE AND $update2 === TRUE && $save === TRUE AND $language == 1) {
                    echo "END You have successfully Send NGN".number_format($amount)." to ".$recieverName;
                }else if ($update === TRUE AND $update2 === TRUE && $save === TRUE AND $language == 2) {
                    echo "END Ka Tura NGN".number_format($amount)." Zuwa ".$recieverName;
                }else if ($update === TRUE AND $update2 === TRUE && $save === TRUE AND $language == 3) {
                    echo "END O ti fi NGN".number_format($amount)." ranṣẹ si ".$recieverName;
                }else if ($update === TRUE AND $update2 === TRUE && $save === TRUE AND $language == 4) {
                    echo "END Ị ezipụla NGN".number_format($amount)." ka ".$recieverName;
                } else {
                    echo "END Network problem, please try again \n later Error 504";
                }
                }}
            
        }else if ($level == 6 && $textArray[5] == 2) {
            //Cancel
            echo "END Canceled. Thank you for using our service";
        } else if ($level == 6 && $textArray[5] == Util::$GO_BACK) {
            echo "END You have requested to back to one step - re-enter PIN";
        } else if ($level == 6 && $textArray[5] == Util::$GO_TO_MAIN_MENU) {
            echo "END You have requested to back to main menu - to start all over again";
        } else if ($language == 1) {
            echo "END Invalid entry";
        }else if ($language == 2) {
            echo "END Baka Saka Dai Dai Ba";
        }else if ($language == 3) {
            echo "END Akọsilẹ ti ko tọ";
        }else if ($language == 4) {
            echo "END Ntinye na ezighi ezi";
        }else{
        echo "END Invalid Language";
    }
        
    }
    
      

    
    
}
?>
