<?php
include('connection.php');
 session_start(); 
if(!isset($_SESSION['name'])){
  header('location:login.php');
}

if(isset($_POST['submit']))
 {
 $name=$_POST['subject_name'];		
$q="INSERT INTO `subject`(`subject_name`) VALUES ('$name')";
 $result = mysqli_query($con,$q);
 if($result){
        echo "<script> alert('Subject add sucessful!')
		     	    window.location.href='index.php';
			        </script>";
 	          }
      else{
        echo "<script> alert('Please Enter valid name')</script>";
            }
    mysqli_close($con);
 	}
include('top.php');
?>

  <div class="limiter">
    <div class="container-login100">
      <div class="wrap-login1000">
        <div class="row" style="margin-right:50px;margin-left:50px;  ">
        <div class="col-lg-12">
        <div id="listWrapper">
        <div class="listPage">
        <h2 class="login100-form-title p-b-26" style="text-align: center; width: 100%;margin-top:100px; ">
          Hello <?php echo $_SESSION['name'];?>!
        </h2>
          <p>
            <span class="login100-form-title p-b-26" style="margin-bottom:10px !important; ">
            Choose a subject to revise
          </span>
          </p>
          <div> 
   
          	<!-- Button trigger modal -->
	           	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  		        Add Subject
		          </button>

		<!-- Modal -->
		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
    		<div class="modal-content">
      		<div class="modal-header">
        		<h5 class="modal-title" id="exampleModalLabel">Add Subject</h5>
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          		<span aria-hidden="true">&times;</span>
        </button>
      		</div>
      		<div class="modal-body">
        		
            <table class="table table-bordered">
              <thead>
              <tr>
                  <th scope="col">Subject Name</th>
                  <th scope="col">Action</th>
              </tr>
            </thead>
              
              <tbody>
                <tr>
    	           <?php
                  $res=mysqli_query($con,"select * from subject order by subject_name desc");
                  while($row=mysqli_fetch_assoc($res)){?>

                  <td> <?php echo $row['subject_name']; ?></td>
                  <td><a href="delete.php?subject_id=<?php echo $row['subject_id']; ?>" Onclick='return checkdelete()'><i class="fa fa-trash" style="font-size:24px"></i></a></td>
                </tr>
		            <?php } ?>
              </tbody>
            </table>
        		
            <form method="post">
          		<div class="mb-3">
            		<label for="recipient-name" class="col-form-label">Add Subject</label>
            		<input type="text" class="form-control" id="recipient-name" name="subject_name">
          		</div>
      		    </div>
      		    <div class="modal-footer">
        		    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        		    <button type="submit" class="btn btn-primary" name="submit">Add Subject</button>
      		    </div>
    		      </div>
    		    </form>
  	</div>
	</div>

          <select name="subject_name" id="name" class="input100" style="margin-top: 14px; margin-bottom: 44px">
           <option selected>Select Subject</option>
            <?php
           $res=mysqli_query($con,"select * from subject order by subject_name desc");
          while($row=mysqli_fetch_assoc($res)){

            echo "<option  value='".$row['subject_id']."'>
            ".$row['subject_name']."</option>";
             }?>
          </select>
          
          </div>               
              <div>     
                <table class="table table-borderless">
                  <tbody id="questionlist">
                  </tbody>
                </table>              
              </div>
      			</div>
      			    
        <div style="display: flex;margin-bottom:50px;margin-top:30px; ">
          <div class="container-login100-form-btn">
            <div class="wrap-login1000-form-btn">
              <div class="login100-form-bgbtn"></div>
              <a href="simon/index.html" class="login100-form-btn"
                class="game-start-btn"
              style="text-align: center; margin-right: 8px">
                Play MiniGame
              </a>
            </div>
          </div>

          <div class="container-login100-form-btn">
            <div class="wrap-login1000-form-btn">
              <div class="login100-form-bgbtn"></div>
              <a href="invoice.php" class="login100-form-btn"
                class="download-data-btn"
                onclick="downloadData()"
                style="text-align: center; margin-right: 8px">
                Download Data
              </a>
            </div>
          </div>
          

          <div class="container-login100-form-btn">
            <div class="wrap-login1000-form-btn">
              <div class="login100-form-bgbtn"></div>
              <a  href="logout.php" class="login100-form-btn" class="logout-btn">
                Logout
              </a>
            </div>
          </div>
           </div>
        </div>


            <div class="container text-center">
                <input type="button" class="btn-success" id="btnPassport" onclick="ShowHideDiv(this)" value="Check Your Progress" style="margin-bottom:10px;">

            <div id="dvPassport" style="display: none">
                <select name="subject_name" id="s_name" class="input100" style="margin-top: 14px; margin-bottom: 44px">
                  <option selected>Select Subject</option>
                    <?php
                      $res=mysqli_query($con,"SELECT DISTINCT n.subject_id,s.subject_name,s.subject_id from subject s join notes n ON s.subject_id=n.subject_id");
                      while($row=mysqli_fetch_assoc($res)){

                      echo "<option  value='".$row['subject_id']."'>
                        ".$row['subject_name']."</option>";
                         }?>
                </select>


           <table class="table table-bordered" >
             <thead class="thead-light">
                <tr class="table-success">
                     <th scope="col">Topic Name</th>
                      <th scope="col">Topic In - Progress</th>
                      <th scope="col">Completed</th>
                </tr>
              </thead>

                  <tbody id="list">
                  </tbody>
            </table>
        </div>
      </div>

<script>
    $(document).ready(function(){    
        $("#name").change(function(){
                var getUserID = $(this).val();
                if(getUserID != '0')
                {
                    $.ajax({
                        type: 'GET',
                        url: 'ajax.php',
                        data: {subject_id:getUserID},
                        success: function(data){
                        var results = JSON.stringify(data);       
                            $("#questionlist").html(data);
                            console.log(getUserID)
                        }
                    });
                }
        });
        
    });
    $(document).ready(function(){    
        $("#s_name").change(function(){
                var getUserID = $(this).val();
                if(getUserID != '0')
                {
                    $.ajax({
                        type: 'GET',
                        url: 'ajax1.php',
                        data: {subject_id:getUserID},
                        success: function(data){
                        var results = JSON.stringify(data);       
                            $("#list").html(data);
                            console.log(getUserID)
                        }
                    });
                }
        });
        
    });

    function checkdelete(){
        return confirm('Are you sure to delete the Subject');
                          }
</script>

<?php include('footer.php');?>