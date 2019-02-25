<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="">
	<script src="jquery-3.1.1.js"></script>
	<script src="artyom.min.js"></script>
	<script src="artyomCommands.js"></script>

	<style>
		.contenedor{
			width: 60%;
			margin-left: auto;
			margin-right: auto;
		}
	</style>
</head>
<body>
	
	<div class="contenedor">		
	
		<!-- botonera -->
		<div style="float: left;padding: 20px;">
			<input type="button" onclick="startArtyom();" value="Start">
			<input type="button" onclick="stopArtyom();" value="Stop">
			<input id="salida" style="width: 400px;" />
		</div>


		
		<br><br><br>

		<div style="padding: 20px;">
			<label for="leer">Escribe un texto para leerlo</label>
			<textarea id="leer" rows="4" cols="100"></textarea>
			<input type="button" id="btnLeer" value="Leer">
		</div>

	</div>

	<script>

		//El sistema responde
		artyom.addCommands([
			{
				indexes:['buenos días','buenas tardes','buenas noches','Hola'],
				action: function(i){
					if (i==0) {
						artyom.say("Buenos dias, en que le podemos ayudar");
					}
					if (i==1) {
						artyom.say("Buenas tardes, en que le podemos ayudar");
					}
					if (i==2) {
						artyom.say("Buenas noches, en que le podemos ayudar");
					}
					if (i==2) {
						artyom.say("Hola, en que le podemos ayudar");
					}
				}
			},
			{
				indexes:['me voy','chau'],
				action: function(){
					artyom.say("cuidate Adios");
										
				}
			},
			/*{
				indexes:['abrir google','abrir facebook', 'abrir youtube'],
				action: function(i){
					if (i==0) {
						artyom.say("Abriendo google");
						window.open("http://www.google.com",'_blank');
					}
					if (i==1) {
						artyom.say("Abriendo facebook");
						window.open("http://www.facebook.com/intecsolt/",'_blank');
					}
					if (i==2) {
						artyom.say("Abriendo youtube");
						window.open("https://www.youtube.com/",'_blank');
					}
				}
			},*/
			{
				indexes:['limpiar'],
				action: function(){
					$('#salida').val('');
				}
			}
		]); 

		// Escribir lo que escucha.
		artyom.redirectRecognizedTextOutput(function(text,isFinal){
			var texto = $('#salida');
			if (isFinal) {
				texto.val(text);
			}else{
				
			}
		});


		//inicializamos la libreria Artyom
		function startArtyom(){
			artyom.initialize({
				lang: "es-ES",
				continuous:true,// Reconoce 1 solo comando y para de escuchar
	            listen:true, // Iniciar !
	            debug:true, // Muestra un informe en la consola
	            speed:1.12 // Habla normalmente
			});
		};
		
		// Stop libreria;
		function stopArtyom(){
			artyom.fatality();// Detener cualquier instancia previa
		};

		// leer texto
		$('#btnLeer').click(function (e) {
            e.preventDefault();
            var btn = $('#btnLeer');
            if (artyom.speechSupported()) {
                btn.addClass('disabled');
                btn.attr('disabled', 'disabled');

                var text = $('#leer').val();
                if (text) {
                    var lines = $("#leer").val().split("\n").filter(function (e) {
                        return e
                    });
                    var totalLines = lines.length - 1;

                    for (var c = 0; c < lines.length; c++) {
                        var line = lines[c];
                        if (totalLines == c) {
                            artyom.say(line, {
                                onEnd: function () {
                                    btn.removeAttr('disabled');
                                    btn.removeClass('disabled');
                                }
                            });
                        } else {
                            artyom.say(line);
                        }
                    }
                }
            } else {
                alert("Your browser cannot talk !");
            }
        });

	// });
	</script>
</body>
</html>