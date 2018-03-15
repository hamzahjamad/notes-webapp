import React from 'react';
import axios from 'axios';

import { Link } from 'react-router-dom';

export default class NoteList extends React.Component {

    constructor(props) {
        super(props);
        this.state = {
            notes: '',
            current_page: '',
            last_page: '',
            disable_load_more: true
        }

        this.loadMore = this.loadMore.bind(this);
    }

    componentDidMount() {
        axios.get('/data/notes')
             .then(response => {
                 this.setState({
                     notes: response.data.data,
                     current_page: response.data.current_page,
                     last_page: response.data.last_page,
                     disable_load_more: response.data.current_page >= response.data.last_page
                 });
             })
             .catch(err => console.log(err));
    }

    noteRow() {
        if(this.state.notes instanceof Array) {
            return this.state.notes.map((object, i) => {
                return (
                    <li key={i} >
                        <Link to={"/app/notes/"+object.id}> {object.title} </Link>
                    </li>
                )
            });
        }
    }

    //todo
    loadMore(e)
    {
        e.preventDefault();
        var nextPage = this.state.current_page + 1;

        axios.get('/data/notes?page=' + nextPage)
             .then(response => {
                   this.setState(function(prevState, props) {
                    console.log('prevState', prevState);
                    console.log('loadMore response', response.data);

                    for (var note of response.data.data) {
                      prevState.notes.push(note);
                    }

                      return {
                        notes: prevState.notes,
                        current_page: response.data.current_page,
                        last_page: response.data.last_page,
                        disable_load_more: response.data.current_page >= response.data.last_page
                      };
                    });
             })
             .catch(err => console.log(err));

  
    }

    render() {
        return (
            <div className="container">
                <div className="row">
                    <div className="col-md-8 col-md-offset-2">
                        <div className="panel panel-default">
                            <div className="panel-heading">Note List</div>

                            <div className="panel-body">
                                <ul>
                                    {this.noteRow()}
                                </ul>
                                <button className="btn btn-default" type="button" onClick={this.loadMore} disabled={this.state.disable_load_more}>Load more</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}
