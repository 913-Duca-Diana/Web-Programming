

<!DOCTYPE html>
<html lang="en">

<head>
    
  


   
  <link rel="stylesheet" href="css/xLAB.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>

</head>
<body>
    <input type="submit" onclick="myFunction()" name="butt" value="Don't press" />
    <div class="background-modal">
        <div class="modal-content" id="mydiv"  >
            <div class="close"><h3 class="close-text"><button class="butt_css" onclick="mFunction()"> <p class="exit_butt">+ </p></button></h3></div>
            <div id="mydivheader">Click here to move</div>
            <div class="mod_content">
                This is some valuable information.
            </div>
          
        </div>
</div>
</body>
</html>

<script>
dragElement(document.getElementById(("mydiv")));

function dragElement(elmnt) {
  var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
  if (document.getElementById(elmnt.id + "header")) {
    document.getElementById(elmnt.id + "header").onmousedown = dragMouseDown;
  } else {
    elmnt.onmousedown = dragMouseDown;
  }

  function dragMouseDown(e) {
    e = e || window.event;
    pos3 = e.clientX;
    pos4 = e.clientY;
    document.onmouseup = closeDragElement;
    document.onmousemove = elementDrag;
  }

  function elementDrag(e) {
    e = e || window.event;
    pos1 = pos3 - e.clientX;
    pos2 = pos4 - e.clientY;
    pos3 = e.clientX;
    pos4 = e.clientY;
    elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
    elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
  }

  function closeDragElement() {
    document.onmouseup = null;
    document.onmousemove = null;
  }
}
</script>
<script type="text/javascript" src="index.js"></script>
<script>
        function myFunction() {

            document.querySelector(".background-modal").style.display = "flex";
           
            
        }
    </script>
     <script>
        function mFunction(){
                
                document.querySelector(".background-modal").style.display = "none";
            }
    </script>