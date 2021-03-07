    $(document).ready(function(){
        $(".notice").fadeOut(6000);
         $(".notice_erro").fadeOut(6000); 
        // var id_keywords=Array();   
              $(".enable_all").click(function (){
                      var check=this.checked;
                      var name_site=$(this).attr('name_site')+'.php';
                      $(".enable").each(function(){
                              this.checked=check;
                              var id=$(this).parent().attr("id");
                              loadXMLDoc('?id='+id+'&name_site='+name_site+'&status=1');
                              //id_keywords.push(id);          
                      });
                      //id_keywords.splice(0,id_keywords.length);
              });
              $(".disable_all").click(function(){
                      var check=this.checked;
                      var name_site=$(this).attr('name_site')+'.php';
                      $(".disable").each(function() {
                              this.checked=check;
                              var id=$(this).parent().attr("id");
                              loadXMLDoc('?id='+id+'&name_site='+name_site+'&status=0');
                              //id_keywords.push(id);    
                      });
                     // id_keywords.splice(0,id_keywords.length);
              });
      });
     function enable(param){
       loadXMLDoc(param);
      }
      function disable(param){
         loadXMLDoc(param);
         }   
     function loadXMLDoc(param){
              var xmlhttp;
              if (window.XMLHttpRequest)
                xmlhttp=new XMLHttpRequest();
              else 
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
              xmlhttp.onreadystatechange=function() {
                  if (xmlhttp.readyState==4 && xmlhttp.status==200)
                         $('#thongbao').html('<div class=notice>'+xmlhttp.responseText+'</div>');
               }
              xmlhttp.open("GET","ajax.php"+param+"",true);
              xmlhttp.send();
      }