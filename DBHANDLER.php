<?php

class DBHANDLER{
 private $connection;
    function __construct() {
        require_once dirname(__FILE__) . '/DBCONNECT.php';
        // opening db connection
        $db = new DBCONNECT();
        $this->connection = $db->connect();
        mysqli_set_charset($this->connection,"utf8");
    }
    
    
  
    
    
    
      
    /// HOME PAGE MODULES......
    /*public function Fetch(){
        
    $HomeData=array();
    
    $HomeData["SLIDER"]=$this->fetchSliders();
    $HomeData["SERVICE_CATEGORIES"]=$this->GetServiceCategories();
    $HomeData["SERVICE_PRODUCTS"]=$this->fetchAllServices();
    
    return $HomeData;

        
        
    }
    private function fetchSliders(){
    
    $data=array();
        
                // fetch the source data using TN..
    $IMG_URL="http://homeservices.vugido.com/IMAGES/";
                $st=$this->connection->prepare("SELECT  IMAGE,ID  FROM  SLIDERS WHERE ACTIVE_STATE = 1");
                
                if($st->execute()){
                    $d=array();
                    
                    $st->bind_result($IMAGE,$ID);
                    
                    $st->store_result();
                    
                    if($st->num_rows>0){
                        
                        while($st->fetch()){
                            
                            
                            array_push($d,array('IMAGE'=>$IMG_URL.$IMAGE,'SID'=>$ID ));
                            
                        }
                       
                       $data=$d;
                      //  array_push($data,array($TN=>$d));

                    }
                    

                }

        return $data;
    }
    private function fetchAllServices(){
    
    $IMG_URL="http://homeservices.vugido.com/IMAGES/";
    $data=array();
    $stmt=$this->connection->prepare("SELECT ID,SID,NAME,IMAGE,DESCRIBER,TAGS  FROM SERVICE_PROFILE WHERE ACTIVE_STATE = 1 ");
    
    if($stmt->execute()){
        
        
        $stmt->bind_result($ID,$SID,$TITLE,$IMG,$DES,$TAGS);
        $stmt->store_result();
        
        if($stmt->num_rows>0){
            
            while($stmt->fetch()){
                
                
                   
                    
                    
                            
              array_push($data,array('IMAGE'=>$IMG_URL.$IMG,  'TITLE'=>$TITLE, 
              'ID'=>$ID,'DESCRIPTION'=>$DES ,'SID'=>$SID,'TAGS'=>$TAGS));
                        
                        
                       

                    
                
                
            }
            
            
        }
        
    }
    
    
    return $data;
    
    
}
    public function GetServiceCategories(){
    
    $data=array();
    //$IMG_URL="http://homeservices.vugido.com/IMAGES/";
    $stmt=$this->connection->prepare("SELECT ID ,SERVICE_NAME FROM SERVICE_TYPE WHERE ACTIVE_STATE = 1 ");
    if($stmt->execute()){
        
        $stmt->bind_result($ID,$TITLE);
        $stmt->store_result();
        
        if($stmt->num_rows > 0){
            
            
            while($stmt->fetch()){
                
                array_push($data,array('ID'=>$ID,'TITLE'=>$TITLE));
                
            }
        
            
            
        }
        
    }
    
    return $data;
    
    
    
    
}










   

    private function getCurrentDateTime(){

    date_default_timezone_set("Asia/kolkata");
	   $t=time();
	   $ON=date("d-m-y h:i:s A",$t);
           return $ON;
}

}
*/
public function get_user($user,$pass){
    $stmt=$this->connection->prepare("SELECT Uid FROM  login_credentials where username = ? and pswd = ?");
    $stmt->bind_param("ss",$user,$pass);
    $d;
    if($stmt->execute()){
        $stmt->bind_result($uid);
        $stmt->store_result();
        
        if($stmt->num_rows > 0){
            $stmt->fetch();
            $stmt=$this->connection->prepare("SELECT * FROM  staff where staff_id = ?");
            $stmt->bind_param("s",$uid);
                        if($stmt->execute()){
                    //$d=array();
                    
                    $stmt->bind_result($ID,$name,$role,$pno,$mail);
                    
                    $stmt->store_result();
                    $stmt->fetch();
                    $d=array('ID'=>$ID,'NAME'=>$name,'ROLE'=>$role,'PHNO'=>$pno,'MailID'=>$mail);
                    return $d;
                    }
                    else{
                        return null;
                    }
}
else{
    return null;
}
}
else{
    return null;
}
}


public function getcount($name){
    $d=array();
    $d['status']=false;
    if(strcmp($name,"categories")==0){
    $stmt=$this->connection->prepare("select count(id) from category");
    
    if($stmt->execute()){
        $stmt->bind_result($categorycount);
        $stmt->store_result();
        $stmt->fetch();
        $d["count"]=$categorycount;
    }
    }
    if(strcmp($name,"products")==0){
    $st=$this->connection->prepare("select count(id) from products");
    if($st->execute()){
        $st->bind_result($productcount);
        $st->store_result();
        $st->fetch();
        $d["count"]=$productcount;
    }
}
if(strcmp($name,"discounts")==0){
    $stmt=$this->connection->prepare("select count(id) from discount");
    
    if($stmt->execute()){
        $stmt->bind_result($discountscount);
        $stmt->store_result();
        $stmt->fetch();
        $d["count"]=$discountscount;
    }
}
if(strcmp($name,"offers")==0){
    $stmt=$this->connection->prepare("select count(id) from products where availdisc=1");
    if($stmt->execute()){
        $stmt->bind_result($discountedcount);
        $stmt->store_result();
        $stmt->fetch();
        $d["count"]=$discountedcount;
    }
}
    //if(!(is_null($d["discount"]) or is_null($d["category"]) or is_null($d["product"]) or is_null($d["discountedprods"]))){
      if(!(is_null($d["count"]))){
        $d['status']=true;
    }
    return $d;
}


public function getCategory(){
    $d=array();
    $d['status']=false;
    $data=array();
    $stmt=$this->connection->prepare("select * from category");
    
    if($stmt->execute()){
        $stmt->bind_result($id,$name,$desc,$imgurl);
        $stmt->store_result();
        if($stmt->num_rows > 0){
            $d['status']=true;
            
            while($stmt->fetch()){
                //$img=$this->getbase64img($imgurl);
                array_push($data,array('id'=>$id,'name'=>$name,'desc'=>$desc,'img'=>$imgurl));
                
            }
        }
    }
    $d['data']=$data;
    return $d;

}
private function getbase64img($imgurl){
    $img = file_get_contents($imgurl);
  
                // Encode the image string data into base64
                    $data = base64_encode($img);
                    return $data;
                // Display the output
                //echo $data;
}
private function getimgbase64($base64_string, $output_file){
        // open the output file for writing
    $ifp = fopen( $output_file, 'wb' ); 

    // split the string on commas
    // $data[ 0 ] == "data:image/png;base64"
    // $data[ 1 ] == <actual base64 string>
    //$data = explode( ',', $base64_string );

    // we could add validation here with ensuring count( $data ) > 1
    fwrite( $ifp, base64_decode( $base64_string ) );

    // clean up the file resource
    fclose( $ifp ); 

    return $output_file; 

}

public function check_login($id){
    $stmt = $this->connection->prepare("select id from loginstatus where login=1 and id=?");
    $stmt->bind_param('i',$id);
    if($stmt->execute()){
        $stmt->bind_result($ID);
        $stmt->store_result();
        if($stmt->num_rows > 0){
            return true;
        }
    }
    return false;
}
public function updateCategories($uid,$id,$name,$desc,$img,$isimgchanged){
    $response=array();
    $response["status"]=false;
    $stmt = $this->connection->prepare("select * from category where id= ? ");
    $stmt->bind_param('s',$id);
    if($stmt->execute()){
        $stmt->bind_result($ID,$Name,$Desc,$imgurl);
        $stmt->store_result();
        $change=0;
        if($stmt->num_rows > 0){
            $stmt->fetch();
            $str="update category set ";
            if(strcmp($name,$Name)){
                $str=$str."name ="."'".$name."'";
                $change=1;
            }
            if(strcmp($desc,$Desc)){
                if($change==1){
                    $str=$str.",";
                }
                $temp="description = '".$desc."'";
                $str=$str.$temp;
                $change=1;
            }
            if($isimgchanged==1){
                //echo $imgurl;
                $arr=explode("/",$imgurl);
                $filename =end($arr);
                //echo $filename;
                if (file_exists($filename)) {
                    
                    unlink($filename);
                }
                $this->getimgbase64($img,$name.".jpeg");

                if($change==1){
                   $str=$str.",";
                }
                $str=$str."imgurl ='http://10.0.2.2/estore/";
                $str = $str.$name.".jpeg'";
                $change=1;
            }
            $str=$str." where id = ?";
            //echo $str;
            if($change==1){
            $stmt = $this->connection->prepare($str);
            $stmt->bind_param('i',$ID);
            if($stmt->execute()){
                $response["status"]=true;
            }
        }
        }
       
}
 return $response;
}
public function deleteCategories($uid,$id){
    $response["status"]=false;
    $stmt = $this->connection->prepare("select imgurl from category where id= ? ");
    $stmt->bind_param('i',$id);
    if($stmt->execute()){
        $stmt->bind_result($filename);
        $stmt->store_result();
        if($stmt->num_rows>0){
        $stmt->fetch();
        }
    }

    $stmt = $this->connection->prepare("delete from category where id= ? ");
    $stmt->bind_param('i',$id);
    if($stmt->execute()){
        $response["status"]=true;
        $this->delimg($filename);
    }
    return $response;
}


    public function InsertCategories($uid,$name,$desc,$img){
        $response=array();
        $response["status"]=false;
        $this->getimgbase64($img,$name.".jpeg");
        $stmt = $this->connection->prepare("insert into category(name,description,imgurl) Values(?,?,?)");
        $n="http://10.0.2.2/estore/".$name.".jpeg";
        $stmt->bind_param('sss',$name,$desc,$n);
        if($stmt->execute()){
                $response["status"]=true;
            }
        return $response;
        }

public function updateProducts($uid,$id,$product_name,$price,$rating,$category_id,$discount_id,$quantity,$description,$features,$availdisc)
{
    $response=array();
    $response["status"]=false;
    $stmt = $this->connection->prepare("select * from products where id= ? ");
    $stmt->bind_param('i',$id);
    if($stmt->execute()){
        $stmt->bind_result($ID,$PRODUCT_NAME,$PRICE,$RATING,$CATEGORY_ID,$DISCOUNT_ID,$QUANTITY,$DESCRIPTION,$FEATURES,$AVAILDISC);
        $stmt->store_result();
        $change=0;
        if($stmt->num_rows > 0){
            $stmt->fetch();
            $str="update products set ";
            if(strcmp($product_name,$PRODUCT_NAME)){
                $str=$str."product_name =";
                $str=$str."'";
                $str=$str.$product_name."'";
                $change=1;
            }
            if(strcmp($price,$PRICE)){
                if($change==1){
                    $str=$str.",";
                }
                $str=$str."price ='";
                $str=$str.$price;
                $str=$str."'";
                $change=1;
            }
            if(strcmp($rating,$RATING)){
                if($change==1){
                    $str=$str.",";
                }
                $str=$str."rating =";
                $str=$str."'";
                $str=$str.$rating;
                $str=$str."'";
                $change=1;
            }
            if(strcmp($category_id,$CATEGORY_ID)){
                if($change==1){
                    $str=$str.",";
                }
                $str=$str."category_id ='";
                $str=$str.$category_id."'";
                $change=1;
            }
            if(strcmp($discount_id,$DISCOUNT_ID)){
                if($change==1){
                    $str=$str.",";
                }
                $str=$str."discount_id ="."'".$discount_id."'";
                $change=1;
            }
            if(strcmp($quantity,$QUANTITY)){
                if($change==1){
                    $str=$str.",";
                }
                $str=$str."quantity ="."'".$quantity."'";
                $change=1;
            }
            if(strcmp($description,$DESCRIPTION)){
                if($change==1){
                    $str=$str.",";
                }
                $str=$str."description ="."'".$description."'";
                $change=1;
            }
            if(strcmp($features,$FEATURES)){
                if($change==1){
                    $str=$str.",";
                }
                $str=$str."features ="."'".$features."'";
                $change=1;
            }
            if(strcmp($availdisc,$AVAILDISC)){
                if($change==1){
                    $str=$str.",";
                }
                $str=$str."availdisc ="."'".$availdisc."'";
                $change=1;
            }
           
            $str=$str." where id = ?";
            //echo $str;
            $stmt = $this->connection->prepare($str);
            $stmt->bind_param('i',$id);
            if($stmt->execute()){
                $response["status"]=true;
            }
            
        }
       
}
 return $response;
}

public function insertProductImg($uid,$pid,$name,$newimg){
    $response=array();
    $response['status']=false;
    $urls=array();
    $st = $this->connection->prepare("select imgurl from product_imgs where id = ?");
        $st->bind_param('i',$pid);
        if($st->execute()){
            $st->bind_result($imgurl);
            $st->store_result();
            while($st->fetch()){
                array_push($urls,$imgurl);
            }
        }
        $count=count($urls);
        $name=$name.$count;
        $imglink="http://10.0.2.2/estore/".$name.".jpeg";
        $this->getimgbase64($newimg,$name.".jpeg");
        $st = $this->connection->prepare("insert into product_imgs(id,imgurl) values(?,?)");
        $st->bind_param('i',$pid);
        if($st->execute()){
            $response['status']=true;
        }
        return $response;
}

public function deleteProductImg($uid,$pid,$name){
    $n="http://10.0.2.2/estore/".$name.".jpeg";
    $response=array();
    $respone['status']=false;
    $st = $this->connection->prepare("delete product_imgs where id=? and imgurl=?");
        $st->bind_param('is',$pid,$n);
        if($st->execute()){
            $response['status']=true;
        }
        return $response;

}

public function deleteProducts($uid,$id){
    $response=array();
    $response["status"]=false;
    $stmt = $this->connection->prepare("delete from products where id = ?");
    $stmt->bind_param('i',$id);
    if($stmt->execute()){
        $st = $this->connection->prepare("select imgurl from product_imgs where id = ?");
        $st->bind_param('i',$id);
        if($st->execute()){
            $st->bind_result($imgurl);
            $st->store_result();
            if($st->num_rows>0){
                while($st->fetch()){
                    $this->delimg($imgurl);
                }
            }
        }
        $st = $this->connection->prepare("delete from product_imgs where id = ?");
        $st->bind_param('i',$id);
        if($st->execute()){
            $response["status"]=true;
        }
        
    } 
    return $response;
}


    public function InsertProducts($uid,$product_name,$price,$rating,$category_id,$discount_id,$quantity,$description,$features,$availdisc){
        $response=array();
        $response["status"]=false;
        $stmt = $this->connection->prepare("insert into products(product_name,price,rating,category_id,discount_id,quantity,description,features,availdisc) Values(?,?,?,?,?,?,?,?,?);");
        $stmt->bind_param("sddiiissi",$product_name,$price,$rating,$category_id,$discount_id,$quantity,$description,$features,$availdisc);
        if($stmt->execute()){
                $response["status"]=true;
            }
        return $response;
        }




public function DisplayProducts($uid,$id=null){
    
    $response=array();
    if($id!=null){
        $stmt = $this->connection->prepare("select products.id,products.product_name,products.price,products.rating,products.category_id,products.discount_id,products.quantity,products.description,products.features,products.availdisc from products where id =?");
        $stmt->bind_param("s",$id);
    }else
    $stmt = $this->connection->prepare("select products.id,products.product_name,products.price,products.rating,products.category_id,products.discount_id,products.quantity,products.description,products.features,products.availdisc from products");
    if($stmt->execute()){
        $stmt->bind_result($product_id,$product_name,$price,$rating,$category_id,$discount_id,$quantity,$description,$features,$availdisc);
        $stmt->store_result();
        if($stmt->num_rows>0){
            while($stmt->fetch()){
                $urls=null;
                $st=$this->connection->prepare("select imgurl from product_imgs where pid = ?");
                $st->bind_param("s",$product_id);
                if($st->execute()){
                    $st->bind_result($imgurl);
                    $st->store_result();
                    if($st->num_rows>0){
                        $urls=array();
                        while($st->fetch()){
                            array_push($urls,$imgurl);
                        }
                    }
                }
                $category_name=$this->getCategoryName($category_id);
                array_push($response,array("product_id"=>$product_id,"product_name"=>$product_name,"product_price"=>$price,"product_rating"=>$rating,"product_categoryname"=>$category_name,"product_discountid"=>$discount_id,"product_quantity"=>$quantity,"product_description"=>$description,"product_features"=>$features,"product_availdisc"=>$availdisc,"product_imgurls"=>$urls));
            }
            return $response;
        }
    }

}

private function getCategoryName($category_id){
    $st=$this->connection->prepare("select name from category where id =?");
                $st->bind_param("s",$category_id);
                $category_name="NA";
                if($st->execute()){
                    $st->bind_result($category_name);
                    $st->store_result();
                    if($st->num_rows>0){
                        $st->fetch(); 
                    }
}
return $category_name;
}
public function delimg($filename){
    $temp = explode("/",$filename);
                    $filename = end($temp);
                    if (file_exists($filename)) {
                            unlink($filename);
                        } 
}

public function getDashboardActivity($uid){
    $response=null;
    $st=$this->connection->prepare("select activityname,iconurl from dashboard");
    if($st->execute()){
        $st->bind_result($activity_name,$icon_url);
        $st->store_result();
                    if($st->num_rows>0){
                        $response=array();
                        while($st->fetch()){
                            array_push($response,array("name"=>$activity_name,"iconurls"=>$icon_url));
                        }
                    }
    }
    return $response;
}
function getDiscounts($uid){
    $respone=null;
    $st=$this->connection->prepare("select * from discount");
    if($st->execute()){
        $st->bind_result($discount_id,$discount_name,$discount_desc,$discount_perc,$discount_active);
        $st->store_result();
                    if($st->num_rows>0){
                        $response=array();
                        while($st->fetch()){
                            array_push($response,array("id"=>$discount_id,"name"=>$discount_name,"desc"=>$discount_desc,"perc"=>$discount_perc,"active"=>$discount_active));
                        }
                    }
    }
    return $response;
}
function deleteDiscount($uid,$id){
    $response=array();
    $response["status"]=false;
    $stmt = $this->connection->prepare("delete from discount where id = ?");
    $stmt->bind_param('i',$id);
    if($stmt->execute()){
            $response["status"]=true;
    }
    return $response;

}
function insertDiscount($uid,$name,$desc,$percentage,$active){
    $response=array();
    $response["status"]=false;
    $stmt = $this->connection->prepare("insert into discount(name,description,percentage,active) values(?,?,?,?)");
    $stmt->bind_param('ssii',$name,$desc,$percentage,$active);
    if($stmt->execute()){
            $response["status"]=true;
    }
    return $response;
}
function updateDiscount($uid,$id,$name,$desc,$perc,$active){
    $response=array();
    $response["status"]=false;
    $stmt = $this->connection->prepare("update discount set name=?,description=?,percentage=?,active=? where id=?");
    $stmt->bind_param('ssiii',$name,$desc,$perc,$active,$id);
    if($stmt->execute()){
            $response["status"]=true;
    }
    return $response;
}
function getOfferproducts($uid){
    $response=array();
    $r=array();
    $response["status"]=false;
    $stmt = $this->connection->prepare("select products.id,products.product_name,category.name,discount.name,discount.percentage from ((products inner join category on category.id=products.category_id) INNER JOIN discount on discount.id=products.discount_id)");
    
    if($stmt->execute()){
        $stmt->bind_result($pid,$pname,$cname,$dname,$dperc);
            $stmt->store_result();
                    if($stmt->num_rows>0){
                        $response["status"]=true;
                        
                        while($stmt->fetch()){
                            array_push($r,array("pid"=>$pid,"pname"=>$pname,"cname"=>$cname,"dname"=>$dname,"dperc"=>$dperc));
                        }
                        $response["data"]=$r;
                    }
    }
    return $response;

}
}
?>

