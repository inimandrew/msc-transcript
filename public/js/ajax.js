let xmlhttp = null;
if (window.XMLHttpRequest) {
    // code for modern browsers
    xmlhttp = new XMLHttpRequest();
 } else {
    // code for old IE browsers
    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
}


function getStudentResult(course,sess_id,matric) {
  xmlhttp.open('GET','/admin/get_result/'+course+'/'+sess_id+'/'+matric, false);
  xmlhttp.send();
  if (xmlhttp.status == 200) {
        return xmlhttp.responseText;
   }
   else return ''
}


function processData(json_data_str, select_elem_id) {

  try {
    let res = JSON.parse(json_data_str)
    let mess = res[1].status;

    let parentSelect = document.getElementById(select_elem_id);


    if(mess == 'failure' | mess == 'no_result'){
        let display =  document.createElement('div');
        let button = document.createElement('button');
        button.setAttribute('class','close');
        button.setAttribute('data-dismiss','alert');
        button.innerHTML = "&times"
        display.setAttribute('class','alert alert-danger alert-dismissable');
        display.innerHTML = res[0].message;
        display.appendChild(button);
        parentSelect.appendChild(display);

    }else if(mess == 'success'){
        let result_array = res[0].result;
        var data = ['Course','Assessment Score','Examination Score','Total Score','Grade'];
        var result_data = [result_array.course,result_array.assessment,result_array.exam,result_array.total,result_array.grade];
        let parent =  document.createElement('table');
        parent.setAttribute('class','table table-bordered');
        let tr = document.createElement('tr');

        for(var i = 0; i < data.length; i++){
            let th = document.createElement('th');
            th.innerHTML = data[i];
            tr.appendChild(th);
        }

        let tr1 = document.createElement('tr');

        for(var i = 0; i < result_data.length; i++){
            let td = document.createElement('td');
            td.innerHTML = result_data[i];
            tr1.appendChild(td);
        }

        parent.appendChild(tr);
        parent.appendChild(tr1);
        parentSelect.appendChild(parent);
        document.getElementById('show_result').style.display = 'none';
        document.getElementById('upgrade_result').style.display = 'inline';
        document.getElementById('result_id').value = result_array.id;

    }



  }
  catch(err) {
    console.log(err.message);
  }
}
