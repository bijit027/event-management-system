<!-- <div class="hello">Hello world</div>

<head>
    <title>Event List</title>
</head>
<body>
    <div class="container" id="container">
        <div class="card-content">
            <div class="card">
                <div class="card-image">
                    <img src="https://www.jquery-az.com/html/images/banana.jpg" alt="">
                </div>

                <div class="card-info">
                    <h3 class="title">Card01</h3>
                    <p>type and scrambled it to make a type specimen book. It has survived not only five centuries, 
                        but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised 
                        in the 1960s with the release of Letraset sheets 
                        containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus</p>
                </div>
            </div>
        </div>

        <div class="card-content">
            <div class="card">
                <div class="card-image">
                    <img src="https://www.jquery-az.com/html/images/banana.jpg" alt="">
                </div>

                <div class="card-info">
                    <h3>Card01</h3>
                    <p>skdfhkjshdfjkh</p>
                </div>
            </div>
        </div>

        <div class="card-content">
            <div class="card">
                <div class="card-image">
                    <img src="https://www.jquery-az.com/html/images/banana.jpg" alt="">
                </div>

                <div class="card-info">
                    <h3>Card01</h3>
                    <p>skdfhkjshdfjkh</p>
                </div>
            </div>
        </div>

        
    </div>

</body> -->

<!-- <div class="container">
    <div class="card">
        <div class="card-header">
        </div>
        <div class="addDiv">
            <div id="card-body">
            </div>
        </div>
    </div>
</div> -->

<div class="card-content"></div>


 <!-- Modal -->
 <div class="modal fade" id="getCodeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
       <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         <h4 class="modal-title" id="myModalLabel"> API CODE </h4>
       </div>
       <div class="modal-body" id="getCode" style="overflow-x: scroll;">
          //ajax success content here.
       </div>
    </div>
   </div>
 </div>

 <!--Registration for event-->
 <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Register For Event</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="registrationForm">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Name:</label>
            <input type="text" name="name" class="form-control" id="recipient-name">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
          </div>
          <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Register</button>
      </div>
        </form>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Register</button>
      </div> -->
    </div>
  </div>
</div>