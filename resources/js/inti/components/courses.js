import React, { Component } from 'react';
import ReactDOM from 'react-dom';

export default class Courses extends Component{
    render() {
        return (
            <div>
                <h2>Aqui va la interface del componente REAC</h2>
            </div>
        )
    }
}

if (document.getElementById('courses')) {
    ReactDOM.render(<Courses />, document.getElementById('courses'));
}