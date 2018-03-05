var xhttp = new XMLHttpRequest();
xhttp.STATUS_OK = 200;
xhttp.doneOK = function() {
  return (this.readyState == xhttp.DONE && this.status == this.STATUS_OK);
};
xhttp.onreadystatechange = function() {
  if(!this.doneOK()) return;
  var json =  JSON.parse(this.responseText),
  	  section = document.querySelector('section'),
  	  button = document.querySelector('button'),
  	  options = {
    	  onChange: function(){
      	  button.classList[JSON.stringify(editor.get()) == originalJSON ? 'add' : 'remove']('disabled');
    	  }
  	  },
  	  editor = new JSONEditor(section, options);
  editor.set(json);
  var originalJSON = JSON.stringify(editor.get()),
      savedPass = '';
  button.addEventListener('click', function(){
    var pass = prompt('Password', savedPass);
    if(pass == null || pass == '') return alert('Enter a password to save');
    savedPass = pass;
    var parameters = 'json=' + JSON.stringify(editor.get()) + '&pass=' + pass;
    xhttp.onreadystatechange = function() {
      if(!this.doneOK()) return;
      try {
        var json =  JSON.parse(this.responseText);
        if(json && typeof json.message !== 'undefined') alert(json.message);
        else alert('Oops an error occured.');
      } catch(e) {
        alert('Oops an error occured.');
      }
    };
    xhttp.open("POST", "JSON.DB.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(parameters);
  }, false)
};
xhttp.open("GET", "JSON.DB.php", true);
xhttp.send();
