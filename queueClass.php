<?php 
class queue {
    public function connect(){
        $db = mysqli_connect("localhost", "root", "", "db");
        if($db == false){
            return null;
        }else{
            mysqli_set_charset($db, "utf8");
            return $db;
        }
    }

    public function addQueue($db, $name, $phone, $film, $amount){
        $reqs = $this->getQueue($db);
        $ops = array(true, true, true, true, true);
        foreach($reqs as $row){
            if($row['phone'] == $phone && $row['status'] != 3){
                return 177013;
            }
            if($row['operator'] > 0){
                $ops[$row['operator']] = false; 
            }
        }

        $operator = 0;
        for($i = 1; $i<=4; $i++){
            if($ops[$i] != false){
                $operator = $i;
                break;
            }
        }

        if($operator > 0){
            $status = 1;
        }else{
            $status = 0;
        }

        if($db != false){
            $sql = "INSERT INTO queue (name, phone, film, amount, operator, status) VALUES('".$name."','".$phone."','".$film."','".$amount. "','" .$operator. "',".$status.");";
            if(mysqli_query($db, $sql) != null){return true;}else{return null;}
        }else{return null;}
        
    }

    public function getQueue($db){
        $sql = 'SELECT * FROM queue';
        $query = mysqli_query($db, $sql);
        if($query != null){
            $data = mysqli_fetch_all($query, MYSQLI_ASSOC);

            if($data != null){
                return $data;
            }
        }

    }

    public function getActiveRequests($db){
        $data = $this->getQueue($db);
        $i=0;
        $activeReq = null;
        if($data == null){
            return null;
        }
        foreach($data as $row){
            if($row['operator'] != null){
                $activeReq[$i] = $row;
                $i++;
            }
        }
        if($activeReq != null){
        return $activeReq;
        }else{return null;}
    }

    public function Unprocessed($db){
        $data = $this->getQueue($db);
        if($data == null){
            return null;
        }
        foreach($data as $row){
            if($row['status'] == 0){
                return $row['id'];
            }
        }
        return 0;
    }

    public function getActiveRequestOP($db, $operator){
        $requests = $this->getActiveRequests($db);
        if($requests != null){
        foreach($requests as $row){
            if($row['operator'] == $operator){
                return $row;
            }
        }}
        return null;
    }

    public function updateQueue($db, $id, $status, $operator){
        if($db != false){
            $sql = "UPDATE queue set operator = ".$operator.", status = ".$status." where id = ".$id.";";
            echo $sql;
            if(mysqli_query($db, $sql) != null){
                return true;
            }else{
                return null;
            }
        }else{
            return null;
        }
    }


    public function pageStart($title){

        echo '<!DOCTYPE HTML>'
        .'<html>'
        
        .'<head>';
            echo '<meta charset="utf-8">';
            echo '<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">';
           echo '<title>'; echo $title; echo'</title>'
            .'<link rel="stylesheet" href="css/stylesheet.css">'
            .'<link href="https://fonts.cdnfonts.com/css/roboto" rel="stylesheet">'
        .'</head>'
        
        .'<body class="body">'
            .'<header>'
                .'<a href="/" class="header">'
                .'<div class="header header-left">'
                    .'<i class="header"></i>'
                    .'<p href="/" class="header">Кіно</p>'
                .'</div>'
                .'</a>'
        
                .'<div class="header header-right">'
                    .'<a class="nav-link header">Про нас</a>'
                    .'<a class="nav-link header" href="/queue.php">Усі заявки</a>'
                    .'<a class="nav-link header" href="/operator.php?operator=1">Меню оператора</a>'
                    .'<a class="nav-link header">Профіль</a>'
                .'</div>'
            .'</header>'
        
            .'<main>'
                .'<div class="card-bg fg">';
    }
    public function pageEnd(){ 
        echo     '</div>'
            .'</main>'
        
            .'<footer class="footer"><label>© 2022 Bayraktar cinema.</label></footer>'
        .'</body>'
        
        .'</html>';
    }
    
}
?>
