import React from 'react';
import ReactDOM from 'react-dom';
import { BrowserRouter, Route } from 'react-router-dom'

import NoteList from './components/NoteList';
import NoteDetail from './components/NoteDetail';
import NoteEdit from './components/NoteEdit';


export default class Main extends React.Component {
    render() {
        return (
            <BrowserRouter>
                <div>
                    <Route exact path="/app" component={NoteList} />
                    <Route exact path="/app/notes" component={NoteList} />
                    <Route exact path="/app/notes/:id" component={NoteDetail} /> 
                    <Route exact path="/app/notes/:id/edit" component={NoteEdit} /> 
                </div>     
            </BrowserRouter>
        );
    }
}

if (document.getElementById('root')) {
    ReactDOM.render(<Main />, document.getElementById('root'));
}
