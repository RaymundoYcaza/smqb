<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Somos Más que Banano - Semana de la Calidad</title>
    <!-- Incluyendo Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.css'); ?>">
</head>

<body>
    <div id="preloader">
        <div class="loader-text">Cargando...</div>
    </div>

    <div id="start-overlay" style="background-color: aquamarine">
        <button id="start-button">Comenzar</button>
    </div>

    <div id="intro-overlay" class="container text-center">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center">
                <img src="<?= base_url('assets/images/platano.png'); ?>" alt="Plátano" class="img-fluid" />
            </div>
            <div class="col-md-6 text-center">
                <h1>Día 1: Plátano</h1>
                <p>
                    El plátano, una de las frutas más consumidas en todo el mundo, es
                    conocido por su sabor dulce y su versatilidad. Se puede disfrutar de
                    diversas formas: frito, asado, en batidos o incluso como base para
                    postres. Es una excelente fuente de energía y potasio.
                </p>
                <button class="btn-orange" id="startquiz-button">
                    Contesta las preguntas
                </button>
            </div>
        </div>
    </div>

    <div id="quiz-overlay" class="text-center">
        <div id="quiz-questions"></div>
        <div class="quiz-buttons">
            <button class="btn-prev" id="prev-btn">Regresar</button>
            <button class="btn-next" id="next-btn">Siguiente</button>
            <button class="btn-submit" id="submit-btn" style="display: none;">Enviar</button>
        </div>
    </div>




    <div id="results-overlay" style="display: none">
        <div class="results-content">
            <h1 id="results-score"></h1>
            <h4>¡Gran trabajo! 🎉 <br />Sigue participando y disfrutando del programa. <br /><br />¡Nos vemos en el próximo capítulo! ✨</h4>
            <button id="continue-btn" class="btn">Continuar</button>
        </div>
    </div>

    <div id="resume-overlay" style="display: none">
        <div class="results-content">
            <h1>¡Sigue participando!</h1>
            <h4>Cada día trae una nueva fruta para desafiar tus conocimientos. ¡No te lo pierdas! 🍌🍍🥭</h4>
        </div>
    </div>

    <video id="video-background" type="video/mp4"></video>

    <!-- Incluyendo Bootstrap JS y dependencias -->
    <script src="<?= base_url('assets/js/jquery-3.5.1.slim.min.js'); ?>"></script>
    <script src="<?= base_url('assets/js/popper.min.js'); ?>"></script>
    <script src="<?= base_url('assets/js/bootstrap.min.js'); ?>"></script>


    <script>
        let userScore = 0;

        document.addEventListener('DOMContentLoaded', function() {
            let currentQuestion = 0;
            const questions = document.querySelectorAll('.quiz-question');
            const prevBtn = document.getElementById('prev-btn');
            const nextBtn = document.getElementById('next-btn');
            const submitBtn = document.getElementById('submit-btn');

            function showQuestion(index) {
                questions.forEach((question, i) => {
                    question.classList.remove('active');
                    question.style.display = 'none';
                });
                questions[index].classList.add('active');
                questions[index].style.display = 'block';
            }

            prevBtn.addEventListener('click', function() {
                if (currentQuestion > 0) {
                    currentQuestion--;
                    showQuestion(currentQuestion);
                }
                toggleButtons();
            });

            nextBtn.addEventListener('click', function() {
                if (currentQuestion < questions.length - 1) {
                    currentQuestion++;
                    showQuestion(currentQuestion);
                }
                toggleButtons();
            });

            function toggleButtons() {
                prevBtn.style.display = currentQuestion === 0 ? 'none' : 'inline-block';
                nextBtn.style.display = currentQuestion === questions.length - 1 ? 'none' : 'inline-block';
                submitBtn.style.display = currentQuestion === questions.length - 1 ? 'inline-block' : 'none';
            }

            // Initialize
            showQuestion(currentQuestion);
            toggleButtons();
        });

        function shuffle(array) {
            for (let i = array.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [array[i], array[j]] = [array[j], array[i]];
            }
        }

        const doleSourceQuestions = [{
                id: 1,
                text: "¿Cuál es el principal nutriente del plátano?",
                options: [{
                        id: 1,
                        answer: "Potasio",
                        isCorrect: true
                    },
                    {
                        id: 2,
                        answer: "Proteína",
                        isCorrect: false
                    },
                    {
                        id: 3,
                        answer: "Vitamina C",
                        isCorrect: false
                    },
                ],
            },
            {
                id: 2,
                text: "¿Cómo se puede consumir el plátano?",
                options: [{
                        id: 1,
                        answer: "Asado",
                        isCorrect: true
                    },
                    {
                        id: 2,
                        answer: "Congelado",
                        isCorrect: false
                    },
                    {
                        id: 3,
                        answer: "Todo lo anterior",
                        isCorrect: false
                    },
                ],
            },
            {
                id: 3,
                text: "¿De qué color es el plátano maduro?",
                options: [{
                        id: 1,
                        answer: "Amarillo",
                        isCorrect: true
                    },
                    {
                        id: 2,
                        answer: "Verde",
                        isCorrect: false
                    },
                    {
                        id: 3,
                        answer: "Rojo",
                        isCorrect: false
                    },
                ],
            },
        ];

        // Aleatoriza las preguntas y las opciones
        const questions = [...doleSourceQuestions];
        shuffle(questions);
        questions.forEach(question => shuffle(question.options));

        // Inserta las preguntas en el HTML
        const quizQuestionsDiv = document.getElementById('quiz-questions');

        questions.forEach((question, index) => {
            const questionDiv = document.createElement('div');
            questionDiv.id = `question${index + 1}`;
            questionDiv.className = 'quiz-question';
            questionDiv.style.display = index === 0 ? 'block' : 'none'; // Muestra la primera pregunta

            const questionHeader = document.createElement('h3');
            questionHeader.innerText = `Pregunta: ${question.text}`;
            questionDiv.appendChild(questionHeader);

            const quizOptionsDiv = document.createElement('div');
            quizOptionsDiv.className = 'text-left';

            question.options.forEach(option => {
                const optionLabel = document.createElement('label');
                const optionInput = document.createElement('input');
                optionInput.type = 'radio';
                optionInput.name = `quiz-option-${question.id}`;
                optionInput.value = option.id;
                optionLabel.appendChild(optionInput);
                optionLabel.append(` ${option.answer}`);
                quizOptionsDiv.appendChild(optionLabel);
                quizOptionsDiv.appendChild(document.createElement('br'));
            });

            questionDiv.appendChild(quizOptionsDiv);
            quizQuestionsDiv.appendChild(questionDiv);
        });

        // Maneja los botones de navegación
        let currentQuestion = 0;
        const prevBtn = document.getElementById('prev-btn');
        const nextBtn = document.getElementById('next-btn');
        const submitBtn = document.getElementById('submit-btn');
        const totalQuestions = questions.length;

        function showQuestion(index) {
            document.querySelectorAll('.quiz-question').forEach((questionDiv, i) => {
                questionDiv.style.display = i === index ? 'block' : 'none';
            });
        }

        function toggleButtons() {
            prevBtn.style.display = currentQuestion === 0 ? 'none' : 'inline-block';
            nextBtn.style.display = currentQuestion === totalQuestions - 1 ? 'none' : 'inline-block';
            submitBtn.style.display = currentQuestion === totalQuestions - 1 ? 'inline-block' : 'none';
        }

        prevBtn.addEventListener('click', function() {
            if (currentQuestion > 0) {
                currentQuestion--;
                showQuestion(currentQuestion);
                toggleButtons();
            }
        });

        nextBtn.addEventListener('click', function() {
            if (currentQuestion < totalQuestions - 1) {
                currentQuestion++;
                showQuestion(currentQuestion);
                toggleButtons();
            }
        });

        // Initialize
        showQuestion(currentQuestion);
        toggleButtons();


        document.getElementById('submit-btn').addEventListener('click', function() {
            let userScore = 0; // Inicializa el puntaje del usuario
            const answers = {};
            let allQuestionsAnswered = true;

            // Recolecta las respuestas seleccionadas
            questions.forEach(question => {
                const selectedOption = document.querySelector(`input[name="quiz-option-${question.id}"]:checked`);
                if (selectedOption) {
                    answers[question.id] = parseInt(selectedOption.value, 10); // Guarda el ID de la respuesta seleccionada
                    // Verifica si la respuesta es correcta y suma puntos
                    const correctOption = question.options.find(option => option.isCorrect);
                    if (correctOption.id === answers[question.id]) {
                        userScore += 40; // Suma 40 puntos por cada respuesta correcta
                    }
                } else {
                    allQuestionsAnswered = false; // Marca como incompleto si falta alguna respuesta
                }
            });

            if (!allQuestionsAnswered) {
                alert('Por favor, responde todas las preguntas antes de enviar.');
                return; // Cancela el envío si alguna pregunta no está respondida
            }

            console.log('Preguntas seleccionadas:', answers);
            console.log('Puntaje del usuario:', userScore);

            // Enviar los datos mediante AJAX
            fetch('<?= base_url('index.php/Answers/recordAnswer') ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({
                        answers: answers,
                        score: userScore // Envía también el puntaje del usuario
                    })
                })
                .then(response => response.json())
                .then(data => {
                    // Maneja la respuesta del servidor
                    console.log(data);
                })
                .catch(error => {
                    console.error('Error:', error);
                });

            console.log('El puntaje es', userScore);

            const resultsScore = document.getElementById("results-score");
            const resultsOverlay = document.getElementById("results-overlay");
            const finalOverlay = document.getElementById("final-overlay");
            const quizOverlay = document.getElementById("quiz-overlay");
            const resumeOverlay = document.getElementById("resume-overlay");
            const continueBtn = document.getElementById("continue-btn");
            continueBtn.onclick = () => {
                resultsOverlay.style.display = "none";
                quizOverlay.style.display = "none";
                resumeOverlay.style.display = "flex";
            };
            resultsScore.innerHTML = `¡Has obtenido <br /><span class="points">${userScore}</span><br /> puntos!`;
            resultsOverlay.style.display = "flex";

        });




        // Botones y overlays

        const startButton = document.getElementById("start-button");
        const startQuizButton = document.getElementById("startquiz-button");

        const video = document.getElementById("video-background");
        const startOverlay = document.getElementById("start-overlay");
        const introOverlay = document.getElementById("intro-overlay");
        const quizOverlay = document.getElementById("quiz-overlay");


        video.addEventListener("canplaythrough", () => {
            preloader.style.display = "none";
            video.style.display = "block";
        });

        video.addEventListener("ended", () => {
            introOverlay.style.display = "flex";
        });

        setVideoSource();

        startButton.addEventListener("click", () => {
            video.play();
            startOverlay.style.display = "none";
        });

        startQuizButton.addEventListener("click", () => {
            introOverlay.style.display = "none";
            quizOverlay.style.display = "inline-grid"; // Mostrar el cuestionario
        });


        function setVideoSource() {
            video.src =
                window.innerWidth <= 768 ?
                "<?= base_url('assets/videos/dia01.webm'); ?>" :
                "<?= base_url('assets/videos/dia01_movil.webm'); ?>";
        }
    </script>

</body>

</html>