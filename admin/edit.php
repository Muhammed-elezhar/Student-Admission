<?php
    $sname = "";
    $gname = "";
    $contact = "";
    $email = "";
    $address = "";
    $class = "";
    $shift = "";
    $gender = "";
    $blgroup = "";
    $division = "";
					
    $esname = "";
    $egname = "";
    $econtact = "";
    $eemail = "";
    $eaddress = "";
    $eclass = "";
    $eshift = "";
    $egender = "";
    $eblgroup = "";
    $edivision = "";


    $sql = "select * from student where id = ".$_GET['eid'];
    $table = mysqli_query($cn, $sql);
    $row = mysqli_fetch_assoc($table);
					
	if(isset($_POST['submit']))
	{
	$sname = $_POST['sname'];
	$gname = $_POST['gname'] ;
	$contact = $_POST['contact'];
	$email = $_POST['email'];
	$address = $_POST['address'];
	$class = $_POST['class'];
	$shift = $_POST['shift'];
						
	if(isset($_POST['gender']))
	$gender = $_POST['gender'];
						
	$blgroup = $_POST['blgroup'];
	$division = $_POST['division'];
						
    $er = 0;
						
    if($sname == "")
    {
        $er++;
        $esname = "*Gerekli";
    }
    else
    {
        $sname = test_input($sname);
        if(!preg_match("/^[a-zA-Z ]*$/",$sname)){
            $er++;
            $esname = "*Yalnızca harflere ve boşluklara izin verilir";
        }
    }

    if($gname == "")
    {
        $er++;
        $egname = "*Gerekli";
    }
    else
    {
		$gname = test_input($gname);
		if(!preg_match("/^[a-zA-Z ]*$/",$gname)){
		$er++;
		$egname = "*Yalnızca harflere ve boşluklara izin verilir";
        }
    }

    if($contact == "")
    {
        $er++;
        $econtact = "*Gerekli";
    }
    else
    {
        $contact = test_input($contact);
        if(!preg_match("/^[+0-9]*$/",$contact)){
            $er++;
            $econtact = "*Yalnızca sayılara izin verilir";
        }
							
    }

        if($email == "")
        {
            $er++;
            $eemail = "*Gerekli";
        }
        else
        {
            $email = test_input($email);
            if(!filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                $er++;
                $eemail = "*E-posta biçimi geçersiz";
            }
            
        }

        if($address == "")
        {
            $er++;
            $eaddress = "*Gerekli";
        }

        if($class == "")
        {
            $er++;
            $eclass = "*Gerekli";
        }

        if($shift == 0)
        {
            $er++;
            $eshift = "*Lütfen seçin";
        }

        if (empty($gender))
        {
            $er++;
            $egender = "*Gerekli";
        } 
        else {
            $gender = test_input($gender);
        }

        if($blgroup == "")
        {
            $er++;
            $eblgroup = "*Gerekli";
        }
        elseif(strlen($blgroup) > 3)
        {
            $er++;
            $eblgroup = "*Gerekli";
        }
        
        else
        {
            $blgroup = test_input($blgroup);
            if(!preg_match("/^[a-zA-Z+-]*$/",$blgroup))
            {
                $er++;
                $eblgroup = "*Gerekli";
            }

        }

        if($division == 0)
        {
            $er++;
            $edivision = "*Lütfen seçin";
        }
        if($er == 0)
        {
            $sql = "update student set sname = '".strip_tags($sname)."', 
            gname = '".strip_tags($gname)."',
            contact = '".strip_tags($contact)."',
            email = '".strip_tags($email)."',
            address = '".strip_tags($address)."',
            class = '".strip_tags($class)."',
            shift = ".strip_tags($shift)." ,
            gender = '".strip_tags($gender)."',
            division = ".strip_tags($division)." where id = ".$_GET['eid'];
            
            if(mysqli_query($cn, $sql))
            {
                print '<span class = "successMessage">Veri güncellemesi başarıyla</span>';
                $row['sname'] = "";
                $row['gname'] = "";
                $row['contact'] = "";
                $row['email'] = "";
                $row['address'] = "";
                $row['class'] = "";
                $row['shift'] = "";
                $row['gender'] = "";
                $row['blgroup'] = "";
                $row['division'] = "";
            }
            else
            {
                print '<span>'.mysqli_error($cn).'</span>';
            }
        }
    }
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>


<div class="form-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title">
                    <h3 id="et">ID Düzenle:
                        <?php print $_GET['eid'].', Adi: '.$row["sname"]; ?> 'in bilgileri</h3>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <form action="" method="post">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="left-side-form">
                                        <h5><label for="sname"> Adı</label>
                                            <span class="error">
                                                <?php print $esname; ?></span></h5>
                                        <p><input type="text" name="sname" value="<?php print $row['sname']; ?>"></p>

                                        <h5><label for="gname"> Soyadı</label><span class="error">
                                                <?php print $egname; ?></span></h5>
                                        <p><input type="text" name="gname" value="<?php print $row['gname']; ?>"></p>

                                        <h5><label for="contact">telefon</label><span class="error">
                                                <?php print $econtact; ?></span></h5>
                                        <p><input type="text" name="contact" value="<?php print $row['contact']; ?>"></p>

                                        <h5><label for="email">e-posta</label><span class="error">
                                                <?php print $eemail; ?></span></h5>
                                        <p><input type="text" name="email" value="<?php print $row['email']; ?>"></p>

                                        <h5><label for="address">address</label><span class="error">
                                                <?php print $eaddress; ?></span></h5>
                                        <p><textarea name="address"><?php print $row['address']; ?></textarea></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="right-side-form">
                                        <h5><label for="class">Öğrencilik Durumu</label><span class="error">
                                                <?php print $eclass; ?></span></h5>
                                        <p><input type="text" name="class" value="<?php print $row['class']; ?>"></p>

                                        <h5><label for="shift">Eğitim Türü</label></h5>
                                        <p><select name="shift" id="">
                                                <option value="0">seçme</option>
                                                <option value="1">NORMAL</option>
                                                <option value="2">Uzaktan</option>
                                            </select><span class="error">
                                                <?php print $eshift; ?></span></p>


                                        <h5><label for="gender">Cinsiyet</label></h5>
                                        <input type="radio" name="gender" value="male"><span>Erkek </span>
                                        <input type="radio" name="gender" value="female"><span>kadın</span>
                                        <span class="error">
                                            <?php print $egender; ?></span>

                                        <h5><label for="blgroup"> Program</label><span class="error">
                                                <?php print $eblgroup; ?></span></h5>

                                        <p><input type="text" name="blgroup" value="<?php print $row['blgroup']; ?>"></p>

                                        <h5><label for="division">Sınıf</label></h5>
                                        <p><select name="division" id="">
                                                <option value="0">1</option>
                                                <option value="1">2</option>
                                                <option value="2">3</option>
                                                <option value="3">4</option>
                                            </select><span class="error">
                                                <?php print $edivision; ?></span></p>

                                        <p><input type="submit" name="submit" value="Save Change"></p>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
