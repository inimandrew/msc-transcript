let xmlhttp = null;
if (window.XMLHttpRequest) {
    // code for modern browsers
    xmlhttp = new XMLHttpRequest();
 } else {
    // code for old IE browsers
    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
}

var phead = null;
var table_res = null;
var semHeader = null;

function getStudentResults(matric) {
  xmlhttp.open('GET','/admin/get_results_all/'+matric, false);
  xmlhttp.send();
  if (xmlhttp.status == 200) {
    return xmlhttp.responseText;
}
else return ''

}

function getWeight(grade){
    if(grade == 'A'){
        weight = 5;
    }else if(grade == 'B'){
        weight = 4;
    }else if(grade == 'C'){
        weight = 3;
    }else if(grade == 'D'){
        weight = 2;
    }else if(grade == 'E'){
        weight = 1;
    }else if(grade == 'F'){
        weight = 0;
    }
    return weight;
}

function processData(json_data_str, select_elem_id) {

    try {
      let res = JSON.parse(json_data_str);
      let mess = res[1].status;

      let parentSelect = document.getElementById(select_elem_id);


      if(mess == 'failure'){
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
          var result_array = res[0].results;

          var data = ['Course','Course Code','Grade','Credit Hour','Grade Point'];
        var student_data = document.createElement('p');
        student_data.innerHTML = res[2].student;
        student_data.setAttribute('id','student_data');

        parentSelect.appendChild(student_data);

            for(let key in result_array){
                let header = document.createElement('h3');
                header.setAttribute('id','semH');
                header.innerHTML = key;
                let parent =  document.createElement('table');
                parent.setAttribute('id','student_result_table');
                parent.setAttribute('class','table table-bordered');
                let thead = document.createElement('thead');
                let tr = document.createElement('tr');

                for(var i = 0; i < data.length; i++){
                    let th = document.createElement('th');
                    th.innerHTML = data[i];
                    tr.appendChild(th);
                }
                thead.appendChild(tr);
                parent.appendChild(thead);

var sum =0;
var sum_cred = 0;
                for(let index in result_array[key]){
                        if(index != 'gpa'){
                            let tr1 = document.createElement('tr');

                let td1 = document.createElement('td');
                td1.innerHTML = result_array[key][index].course;
                tr1.appendChild(td1);
                let td2 = document.createElement('td');
                td2.innerHTML = result_array[key][index].code;
                tr1.appendChild(td2);
                let td5 = document.createElement('td');
                td5.innerHTML = result_array[key][index].grade;
                tr1.appendChild(td5);
                let td6 = document.createElement('td');
                td6.innerHTML = result_array[key][index].credit_hour;
                sum_cred = sum_cred + result_array[key][index].credit_hour;
                tr1.appendChild(td6);
                let td7 = document.createElement('td');
                var mult = result_array[key][index].credit_hour * this.getWeight(result_array[key][index].grade)
                td7.innerHTML = mult;
                tr1.appendChild(td7);
                sum = sum + mult;

                parent.appendChild(tr1);
            }
               }
               let tr2 = document.createElement('tr');

               let td0 = document.createElement('td');
               tr2.appendChild(td0);
               let td1 = document.createElement('td');
               td1.setAttribute('class','right');
                td1.innerHTML = "GPA";
                tr2.appendChild(td1);
                let td5 = document.createElement('td');
                td5.innerHTML = sum/sum_cred;
                tr2.appendChild(td5);
                let td6 = document.createElement('td');
                td6.innerHTML = sum_cred;
                tr2.appendChild(td6);
                let td7 = document.createElement('td');
                td7.innerHTML = sum;
                tr2.appendChild(td7);

                parent.appendChild(tr2);

                    parentSelect.appendChild(header);
                    parentSelect.appendChild(parent);


            }
            document.getElementById('student_id').value = document.getElementById('matric_no').value;
            document.getElementById('transcript').style.display = 'inline';


      }



    }
    catch(err) {
      console.log(err.message);
    }
  }
