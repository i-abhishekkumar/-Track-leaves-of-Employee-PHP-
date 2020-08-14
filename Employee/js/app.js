
// Script to prevent resubmittion in Browser
if ( window.history.replaceState ) {
      window.history.replaceState( null, null, window.location.href );
  }

// code to clear the Right side fileds
document.getElementsByClassName("clear").addEventListener("click", clear);

function clear(){
  document.getElementsByClassName("cleartable").innerHTML = '';
 

}

