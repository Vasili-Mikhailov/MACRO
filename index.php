<!DOCTYPE html>
<html>
    <head>
        <!-- Подключение bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <title>MACRO</title>
    </head>
    <body>
        <main>
            <div class="container" id="app">
                <div class="card border-dark mb-3" v-for="topic in topics">
                    <!-- Заголовок текста -->
                    <div class="card-header">
                        <h4 class="card-title">{{ topic.title }}</h4>
                    </div>
                    <!-- Секция текста-->
                    <div class="card-body text-dark">
                        <p class="card-text">{{ topic.text }}</p>
                    </div>
                    <div class="card-footer">
                        <!-- Секция комментариев -->
                        <div class="card">
                            <div class="card-header">
                                Комментарии
                            </div>
                            <ul v-for="comment in topic.comments" class="list-group list-group-flush">
                                <li class="list-group-item">
                                    {{ comment.comment }}
                                    <small class="text text-muted">{{ comment.date }}</small>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!-- Подключение Vue, Axios и основного скрипта-->
        <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <script src="main.js"></script>
    </body>
</html>
