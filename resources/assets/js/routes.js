import React from 'react';
import ReactDOM from 'react-dom';
import { BrowserRouter, Route } from 'react-router-dom'

import Navbar from './components/Navbar';
import NoteList from './components/NoteList';
import NoteDetail from './components/NoteDetail';


export default class Routes extends React.Component {
    render() {
        return (
            <BrowserRouter>
                <div>
                    <Navbar />
                    <Route exact path="/" component={NoteList} />
                    <Route path="/notes/:id" component={NoteDetail} /> 
                </div>     
            </BrowserRouter>
        );
    }
}

if (document.getElementById('root')) {
    ReactDOM.render(<Routes />, document.getElementById('root'));
}
