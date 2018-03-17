import React from 'react';
import axios from 'axios';
import { Link } from "react-router-dom";

export default class NoteDetail extends React.Component {

    constructor(props) {
        super(props);
        this.state = {
            note: '',
            id: this.props.match.params.id
        }
    }

    componentDidMount() {
        axios.get('/data/notes/'+this.state.id)
             .then(response => {
                 this.setState({
                     note: response.data
                 });
             })
             .catch(err => console.log(err));
    }

    contentRow() {
        if(this.state.note.contents instanceof Array) {
            return this.state.note.contents.map((object, i) => {
                console.log('object:' , object);
                return (
                    <li key={i} >
                        {object.content}
                    </li>
                )
            });
        }
    }

    render() {
        return (
            <div className="container">
                <div className="row">
                    <div className="col-md-8 col-md-offset-2">
                        <div className="panel panel-default">
                            <div className="panel-heading">{this.state.note.title}</div>

                            <div className="panel-body">
                                <ul>
                                    {this.contentRow()}
                                </ul>
                                <Link className="btn btn-default" to={'/app/notes/'+this.state.note.id+'/edit'}>Edit</Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}
