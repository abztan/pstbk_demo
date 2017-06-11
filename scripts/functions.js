function validate(value) {
  var email = document.getElementById("email").value;
  var body = document.getElementById("message_body").value;

  if(email === "" || body === "") {
    document.getElementById("send_button").disabled = "disabled";
  }
  else {
    document.getElementById("send_button").disabled = "";
  }
}

function send_message() {
  var user_uri = "0ffx";
  var user_name = document.getElementById("name").value;
  var email = document.getElementById("email").value;
  var contact_number = document.getElementById("contact").value;
  var subject = document.getElementById("message_subject").value;
  var body = document.getElementById("message_body").value;

  document.getElementById("message_box").style.display = "none";
  document.getElementById("error_box").style.display = "none";
  document.getElementById("loader").style.display = "";
  //force display error message
  var x = subject.indexOf("frc_err");

  if(x === -1) {
    var xmlhttp = null;
    if(typeof XMLHttpRequest != 'udefined'){
        xmlhttp = new XMLHttpRequest();
    }else if(typeof ActiveXObject != 'undefined'){
        xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
    }else
        throw new Error('You browser doesn\'t support ajax');

    xmlhttp.open('POST', 'scripts/mailgun_script.php?uri=' + user_uri +
                 '&nam=' + user_name +
                 '&ema=' + email +
                 '&num=' + contact_number +
                 '&sub=' + subject +
                 '&bod=' + body, true);
    xmlhttp.onreadystatechange = function (){
      if(xmlhttp.readyState == 4 && xmlhttp.status==200) {
        //if sending is successful, update sql database
        insert_mysql(user_uri, user_name, email, contact_number, subject, body);
        document.getElementById("success_box").style.display = "";
        document.getElementById("loader").style.display = "none";
      }
    }
  }
  else {
    document.getElementById("loader").style.display = "none";
    document.getElementById("error_box").style.display = "";
    //if forced to fail, updated subject to attempt resending
    if(x !== -1) {
      document.getElementById("message_subject").value = "bypass error";
    }
  }
  xmlhttp.send(null);
}

function insert_mysql(user_uri, user_name, email, contact_number, subject, body) {
  var xmlhttp = null;
  if(typeof XMLHttpRequest != 'udefined'){
      xmlhttp = new XMLHttpRequest();
  }else if(typeof ActiveXObject != 'undefined'){
      xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
  }else
      throw new Error('You browser doesn\'t support ajax');

  xmlhttp.open('POST', 'scripts/mysql_script.php?uri=' + user_uri +
               '&nam=' + user_name +
               '&ema=' + email +
               '&num=' + contact_number +
               '&sub=' + subject +
               '&bod=' + body, true);
  xmlhttp.onreadystatechange = function (){
  };
  xmlhttp.send(null);
}

/*function updateSize() {
  var nBytes = 0,
      oFiles = document.getElementById("fileElem").files,
      nFiles = oFiles.length;
  for (var nFileId = 0; nFileId < nFiles; nFileId++) {
    nBytes += oFiles[nFileId].size;
  }
  var sOutput = nBytes + " bytes";
  // optional code for multiples approximation
  for (var aMultiples = ["KiB", "MiB", "GiB", "TiB", "PiB", "EiB", "ZiB", "YiB"], nMultiple = 0, nApprox = nBytes / 1024; nApprox > 1; nApprox /= 1024, nMultiple++) {
    sOutput = nApprox.toFixed(3) + " " + aMultiples[nMultiple];
  }
  // end of optional code
  document.getElementById("fileNum").innerHTML = nFiles;
  document.getElementById("fileSize").innerHTML = sOutput;
}*/
