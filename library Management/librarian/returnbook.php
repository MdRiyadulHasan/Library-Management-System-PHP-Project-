<?php 
require_once 'l_header.php';
?>
           <!-- content HEADER -->
                <!-- ========================================================= -->
                <div class="content-header">
                    <!-- leftside content header -->
                    <div class="leftside-content-header">
                        <ul class="breadcrumbs">
                            <li><i class="fa fa-home" aria-hidden="true"></i><a href="#">Dashboard</a></li>
                            <li><a href="javascript: avoid(0)">Return Books</a></li>
                           
                        </ul>
                    </div>
                </div>
                <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
                <div class="row animated fadeInUp">
				    
                    <div class="col-sm-12">
                    <h4 class="section-subtitle"><b>Return Books</b></h4>
                    <div class="panel">
                        <div class="panel-content">
                            <div class="table-responsive">
                                <table id="basic-table" class="data-table table table-striped nowrap table-hover table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>Name</th>                                  
                                        <th>Roll</th>
                                        <th>Phone</th>
                                        <th>Book Name</th>
                                        <th>Book Image</th>
                                        <th>Issue Date</th>
                                        <th>Return Book</th>
                                       
                                    </tr>
                                    </thead>
                                    <tbody> 
									<?php
									 $result= mysqli_query($con,"SELECT issue_books.id,issue_books.book_id,issue_books.book_issue_date, students.firstname, students.lastname, students.roll, students.phone,books.book_name,books.book_image
                                     FROM issue_books INNER join students on students.id=issue_books.student_id
                                     INNER join books on books.id=issue_books.book_id where issue_books.book_return_date=''");
									 while($row=mysqli_fetch_assoc($result)){
										 ?>
										 <tr> 
									         <td><?= ucwords($row['firstname'] . ' '. $row['lastname']) ?></td>
											 <td><?= $row['roll'] ?></td>
											 <td><?=$row['phone'] ?></td>
											 <td><?=$row['book_name'] ?></td>
											 <td><img style="width:120px;" src="../images/books/<?=$row['book_image'] ?>" alt="" /></td>	 
											 <td><?=$row['book_issue_date'] ?></td>	
                                             <td><a href="returnbook.php?id=<?= $row['id']?>&bookid=<?=$row['book_id']?>">Return Book</a></td>											 
											 
									     </tr>
										 <?php
									 }
									
									?>
									   
									</tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
					
               </div>  
			   
			   <?php 
			   if(isset($_GET['id'])){
				 $id=$_GET['id'];
				 $bookid=$_GET['bookid'];
				 $date=date('d-M-Y');
				 $result=mysqli_query($con,"update issue_books set book_return_date='$date' where id='$id'");
				 if($result){
					mysqli_query($con,"update books set available_qty=available_qty+1 where id='$bookid'");
					 ?>
					 <script type="text/javascript"> 
					 alert('Book returns successfully !');
					 javascript:history.go(-1);
					 </script>
					 <?php
					 
				 }else{
					 ?>
					 <script type="text/javascript"> 
					 alert('Something wrong !');
					 </script>
					 <?php
					 
				 }
			   }
			   ?>
      
     <?php 
	 require_once 'l_footer.php';
	 ?>