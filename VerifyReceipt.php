<?php
    include "connection.php";
    if(isset($_REQUEST["rollno"]))
    {
      $roll_no=$_REQUEST["rollno"];
      session_start();
      $_SESSION['rollno'] = $roll_no;
      $fetch=mysqli_query($connection,"select * from std_detail where std_rollno='$roll_no' ");
      $fetch1=mysqli_query($connection,"select * from receipt where std_rollno='$roll_no' ");
      $fetch2=mysqli_query($connection,"select * from receipt where std_rollno='$roll_no' ");
      if(mysqli_fetch_assoc($fetch2))
      {
        while($res=mysqli_fetch_assoc($fetch))
        {
          $_SESSION['roll'] = $res['std_rollno'];
            while($res1=mysqli_fetch_assoc($fetch1))
            {
              if($res1['year'] == NULL or $res1['semester']== NULL or $res1['stream']==NULL or $res1['sumofrupee']  == NULL or $res1['payvia'] == NULL )
              {
?>
                <script>
                  window.alert("The user has not filled his/her details.");
                  window.location.href='Admin.php';
                </script>
<?php
              }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Verify Receipt</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  <link rel="stylesheet" href="CSS2.css">
</head>
<body>
  <nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-nav-demo" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a href="About.html" class="navbar-brand"><i class="fas fa-user-friends"></i></span> About</a>
      </div>
      <div class="collapse navbar-collapse" id="bs-nav-demo">
          <ul class="nav navbar-nav">
              <li><a href="Admin.php"><h4 style="display: inline;" class="fas fa-search"> Admin Search</h4></a></li>
          </ul>
        <ul class="nav navbar-nav navbar-right">
            <li class="active"><a href="AdminLogin.php">Admin <i class="fas fa-user"></i></a></li>
            <li><a href="Logout.php">Logout <i class="fas fa-sign-out-alt"></i></a></li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="container">
    <div class="jumbotron" style="background: none; box-shadow: 1px 2px 5px 5px; padding: 1px">
        <h3 align="center" style="text-shadow: 1px 1px;">STUDENT COPY</h3>
        <h1 align="center">ABC WXYZ Engineering College</h1>
        <h4 align="center">QQQQ, WWWW, YYYY, India - 999999, Phone: 1234567890</h4>
        <h4 align="center">Money Receipt</h4>
    </div>
    <form name="myform" action="document.php" method="POST" onsubmit="return formcheck()">
      <div class="boxDisabled">
        <fieldset>
          <div class="row">
              <div class="col-sm-6">
                  <div class="thumbnail">
                      <label for="name">Student's Name (BLOCK LETTER):</label>
                      <input disabled required type="text" onkeypress="return NAME(event,this);" class="validate form-control input" id="name" name="name" placeholder="Your name.." value="<?php  echo $res['std_name']?>">
                  </div>
              </div>
              <div class="col-sm-6">
                  <div class="thumbnail">
                      <label for="email">Email ID:</label>
                      <input disabled required type="email" onkeypress="return EMAIL(event,this);" class="form-control input" id="email" name="email" placeholder="Make sure it is correct, to receive the receipt.." value="<?php  echo $res['std_email']?>">
                  </div>
              </div>
              <div class="col-sm-6 col-lg-3">
                  <div class="thumbnail">
                      <label for="number">Phone Number: </label>
                      <input disabled required maxlength="10" data-length="10" type="text" class="form-control input" id="number" name="number" placeholder="Your contact number.." value="<?php  echo $res['std_number']?>">
                  </div>
              </div>
              <div class="col-sm-6 col-lg-3">
                  <div class="thumbnail">
                      <label for="studentID">Student ID Number: </label>
                      <input disabled required maxlength="10" data-length="10" type="text" class="form-control input" id="studentID" name="studentID" placeholder="Enter Student ID.." value="<?php ; echo $res['std_id']?>">
                  </div>
              </div>
              <div class="col-sm-6 col-lg-3">
                  <div class="thumbnail">
                      <label for="regno">Registration Number: </label>
                      <input disabled required maxlength="12" data-length="12" type="text" class="form-control input" id="regno" name="regno" placeholder="Enter registration no..." value="<?php  echo $res['std_regno']?>">
                  </div>
              </div>
              <div class="col-sm-6 col-lg-3">
                  <div class="thumbnail">
                      <label for="rollno">Roll Number: </label>
                      <input disabled required maxlength="11" data-length="11" type="text" class="form-control input" id="rollno" name="rollno" placeholder="Enter roll no..." value="<?php  echo $res['std_rollno']?>">
                  </div>
              </div>
          </div>
        </fieldset
        >
          <div class="form-horizontal">
            <div class="col-sm-4">
                <div class="thumbnail">
                    <label for="stream">Stream- </label>
                    <select disabled required name="stream" id="stream" class="form-control input">
                      <option select="selected" required name="stream" value="<?php  echo $res1['stream']?>"id="stream" class="form-control input"><?php  echo $res1['stream']?></option>
                    </select>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="thumbnail">
                    <label for="year" style="margin-left: 5px;">Year-</label>
                    <select disabled required name="year" id="year" class="form-control input">
                      <option select="selected" required name="year" value="<?php  echo $res1['year']?>"id="year" class="form-control input"><?php  echo $res1['year']?></option>
                    </select>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="thumbnail">
                    <label for="semester" style="margin-left: 5px;">Semester-</label>
                    <select disabled required name="semester" id="semester" class="form-control input">
                      <option select="selected" required name="semester" value="<?php  echo $res1['semester']?>" id="semester" class="form-control input"><?php  echo $res1['semester']?></option>
                    </select>
                </div>
            </div>
            <label class="thumbnail"><h3><b>Fees Details:</b></h3>(in rupees)</label>
            <div class="thumbnail">
              <center>
                <label for="rupees">Received a sum of Rupees:</label>
                <input disabled required onkeypress="return RUPEES(event,this);" type="text" name="rupees" id="rupees" value="<?php  echo $res1['sumofrupee']?>" placeholder="Amount in words..">
              </center>
            </div> 
            <fieldset>
              <div class="row">
                <div class="atLeastOne">
                  <div class="col-sm-6">
                    <label for="cb1" class="thumbnail col-xs-7 control-label">Development Fees:</label>
                    <div class="col-xs-5">
                      <input disabled type="text" name="cb1" id="cb1" value="<?php  echo $res1['dfees']?>" placeholder="0"><br>
                    </div>
                    <label for="cb2" class="thumbnail col-xs-7 control-label">Registration Fees:</label>
                    <div class="col-xs-5">
                      <input disabled type="text" name="cb2" id="cb2" value="<?php  echo $res1['rfees']?>" placeholder="0"><br>
                    </div>
                    <label for="cb3" class="thumbnail col-xs-7 control-label">Exam Fees:</label>
                    <div class="col-xs-5">
                      <input disabled type="text" name="cb3" id="cb3" value="<?php  echo $res1['efees']?>" placeholder="0"><br>
                    </div>
                    <label for="cb4" class="thumbnail col-xs-7 control-label">PPR/PPS:</label>
                    <div class="col-xs-5">
                      <input disabled type="text" name="cb4" id="cb4" value="<?php  echo $res1['ppfee']?>" placeholder="0"><br>
                    </div>
                    <label for="cb5" class="thumbnail col-xs-7 control-label">Back Log:</label>
                    <div class="col-xs-5">
                      <input disabled type="text" name="cb5" id="cb5" value="<?php  echo $res1['backlog']?>" placeholder="0"><br>
                    </div>
                    <label for="cb6" class="thumbnail col-xs-7 control-label">Other:</label>
                    <div class="col-xs-5">
                      <input disabled type="text" name="cb6" id="cb6" value="<?php  echo $res1['other']?>" placeholder="0"><br>
                    </div>
                  </div>
                </div>

                <div class="col-sm-6">
                  <label for="payvia" class="thumbnail col-xs-4 control-label" for="payvia">Select payment method-</label>
                  <div class="col-xs-8">
                    <div class="thumbnail">
                      <input disabled type="text" name="cb6" id="cb6" <?php if($res1['payvia']=='chkdd'){?>value="Cheque/DD"<?php }else{?>value="Cash"<?php }?> placeholder="0">
                    </div>
                  </div>
                  <fieldset id="chkdd" class="col-xs-12">
                    <label class="thumbnail col-xs-5 control-label"  for="num">Cheque/DD number:</label>
                    <div class="col-xs-7">
                      <input disabled required="" name="num"  type="text" value="<?php  echo $res1['checkno']?>"id="num"><br>
                    </div>
                    <label class="thumbnail col-xs-5 control-label"  for="bank">Issuing bank:</label>
                    <div class="col-xs-7">
                      <input disabled required="" name="bank" type="text" value="<?php  echo $res1['bank']?>" id="bank" onkeypress="return RUPEES(event,this);"><br>
                    </div>
                    <label class="thumbnail col-xs-5 control-label"  for="branch">Bank branch:</label>
                    <div class="col-xs-7">
                      <input disabled required="" type="text" name="branch" value="<?php  echo $res1['branch']?>" id="branch" onkeypress="return RUPEES(event,this);"><br>
                    </div>
                    <label class="thumbnail col-xs-5 control-label"  for="date">Cheque/DD date:</label>
                    <div class="col-xs-7">
                      <input disabled required="" name="date" type="text" value="<?php  echo $res1['dateofissue']?>" id="date">
                    </div>
                  </fieldset>
                </div>
              </div>
              <div class="row">
                    <div class="col-xs-6">
                      <label class="thumbnail" for="Comments">Comments:</label>
                      <textarea disabled name="Comments" id="Comments" placeholder="Write number printed on notes (if asked)." style="height:100px; width: 100%;"></textarea><br>
                    </div>
                  <?php 
                      $payvia = $res1['payvia'];//What is this????????????????????????????????????????????????  style="border-style: solid; border-color: red;"
                      if($payvia=="chkdd"){}
                    ?>
                    <div class="col-xs-6">
                        <center><button class="btn btn1">Verify</button></center>
                    </div>
              </div>
             </fieldset>
          </div>
      </div>
    </form>
  </div>
  <script src="https://code.jquery.com/jquery-3.4.0.js" integrity="sha256-DYZMCC8HTC+QDr5QNaIcfR7VSPtcISykd+6eSmBW5qo=" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script>
    // function formcheck(){
    //     var total=0;
    //     var fields = $(".atLeastOne")
    //     .find("input").serializeArray();
    //     $.each(fields, function(i, field) {
    //         if (field.value!="")
    //             total=total+parseInt(field.value);
    //     }); 
    //     if(total==0){
    //         alert("Please fill the amount of fees that you want to pay, in the respective fields.");
    //         return false;
    //     }
    //     else{
    //         if(confirm("Total amount to be paid = Rs. "+total))
    //             return true;
    //         else
    //             return false;
    //     }
    // }
    <?php
    if($payvia=='chkdd')
    {
    ?>
        $("#chkdd").prop('disabled', false);
        $("#chkdd").show();
    <?php
    }
    else
    {
    ?>
      $("#chkdd").prop('disabled', true);
      $("#chkdd").hide();
    <?php
    }
    ?>
    $('select[name="payvia"]').change(function()
    {
      if ($(this).val() == "Cash")
      {
        $("#chkdd").prop('disabled', true);
        $("#chkdd").hide();
      }
      else
      {
        $("#chkdd").prop('disabled', false);
        $("#chkdd").show();
      }
    });
    $(function(){
        $('#cb1, #cb2, #cb3, #cb4, #cb5, #cb6, #num').keypress(function(e){
            let allow_char = [48,49,50,51,52,53,54,55,56,57];
            if(allow_char.indexOf(e.which) !== -1 );
            else{
                window.alert("Please enter a digit!");
                return false;
            }
        });
    });
    $(document).ready(function() { $('.form-popup').modal({ show: true, }) });
    function RUPEES(e, t) {
        try {
            if (window.event) {
                var charCode = window.event.keyCode;
            }
            else if (e) {
                var charCode = e.which;
            }
            else { return true; }
            if ((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123) || charCode==32)
                return true;
            else{
                window.alert("Please enter alphapets or space.");
                return false;
            }
        }
        catch (err) {
            alert(err.Description);
        }
    }
  </script>
</body>
</html>
<?php
          }
        }
      }
      else
      {
?>
      <script>
        alert("Search by entering correct roll number in Admin Page.");
        window.location.href='Admin.php';
      </script>
<?php
      }
    }
?>