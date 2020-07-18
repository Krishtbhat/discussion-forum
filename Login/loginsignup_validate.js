function validate1(id)
{	var a=document.getElementById(id);
	//validation of usn
	if(id=="usn")
	{	
		var pos=a.value.search(/^1BM\d{2}[A-Z][A-Z]\d{3}$/);
		if(pos==-1){
			alert("The usn format is incorrect");
			a.focus(); 
			a.select();
		}
	}

}
function validate2(id1)
{	var b=document.getElementById(id1);
	var pos1;
	if(id1=="usn1"){
		pos1=b.value.search(/^1BM\d{2}[A-Z][A-Z]\d{3}$/);
		if(pos1==-1){
			alert("The usn format is incorrect");
			b.focus();
			b.select();
		}
	}
	else if(id1=="emid1"){
		pos1=b.value.search(/^[A-Za-z0-9]+\.[a-z][a-z]\d{2}@bmsce\.ac\.in$/);
		if(pos1==-1){
			alert("Enter valid college email id ");
			b.focus();
			b.select();
		}
	}
	else if(id1=="repass1"){
		var c=document.getElementById("pass1");
		if(b.value!=c.value){
			alert("The passwords are not matching");
			b.focus();
			b.select();
		}
	}
}
