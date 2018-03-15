import React from 'react';
import axios from 'axios';

export default class NoteEdit extends React.Component {

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
            console.log('note', this.state.note);
                return this.state.note.contents.map((object, i) => {
                    console.log('object:' , object);
                    if(this.state.note.type == "text") {
                        return (
                            <textarea key={i} className="form-control" rows="3" defaultValue={object.content}></textarea>
                        )
                    } else {
                        return (
                            <li key={i} >
                                {object.content}
                            </li>
                        )
                    }
                });
            
        }
    }

    content()
    {
        if(this.state.note.type == "text") {
           return this.contentRow()
        } else {
            return (
                    <ul>
                        {this.contentRow()}
                    </ul>
            );
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
                                {this.content()}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}
