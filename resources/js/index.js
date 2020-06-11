import React from "react";
import ReactDOM from "react-dom";
import "./index.css";
import App from "./App";


// https://www.stayawaken.com/2018/11/12/chat-web-app-using-reactjs-redis-and-laravel/
// streamable.com/wcbi2  laravel react config > laravel > preset copy all C-R-A src/ and paste in resource js folder (Clear all) > webpack.mix.js resources/js/index.js > welcome.blade.php {{ mix('/js/index.js') }} {{ mix('/css/app.css') }}  <div id="root"></div>

https: ReactDOM.render(<App />, document.getElementById("root"));
