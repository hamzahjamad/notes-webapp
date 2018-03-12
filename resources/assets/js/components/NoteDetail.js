import React from 'react';
import axios from 'axios';

export default class NoteDetail extends React.Component {

    constructor(props) {
        super(props);
        this.state = {
            note: ''
        }
    }

    componentDidMount() {
        axios.get('/data/notes/1')
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}
