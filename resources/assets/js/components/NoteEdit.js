import React from 'react';
import axios from 'axios';
import {
    Redirect
  } from "react-router-dom";

export default class NoteEdit extends React.Component {

    constructor(props) {
        super(props);
        this.state = {
            title: '',
            contents: [],
            type: '',
            doneUpdate: false,
            id: this.props.match.params.id
        }

        this.updateTitle = this.updateTitle.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
    }

    componentDidMount() {
        axios.get('/data/notes/'+this.state.id)
             .then(response => {
                 this.setState({
                     title: response.data.title,
                     contents: response.data.contents,
                     type: response.data.type
                 });

                 console.log('state', this.state);
             })
             .catch(err => console.log(err));
    }

    handleSubmit(e) {
        e.preventDefault();
        console.log("TODO work on save note", this.state);

        axios.patch('/data/notes/'+this.state.id, {
            title: this.state.title,
            content: this.state.contents 
        })
        .then(response => {
            console.log("save data", response.data);
            this.setState({
                doneUpdate: true
            });
        })
        .catch(err => console.log(err));
    }

    updateContent(contentId, index, e) {
   
        (this.state.contents)[index].content = e.target.value;

        // re-render = eventhough not needed for now
        this.forceUpdate();
    }

    updateTitle(e) {
        this.setState({ title : e.target.value });
    }

    contentRow() {
        if(this.state.contents instanceof Array) {
                return this.state.contents.map((object, i) => {
                    console.log('object:' , object);
                    if(this.state.type == "text") {
                        return (
                            <div className="form-group" key={i}>
                                <textarea className="form-control" rows="3" defaultValue={object.content} onChange={(e) => this.updateContent(object.id, i, e)}></textarea>
                            </div>
                        )
                    } else {
                        return (
                            <div className="form-group" key={i}>
                                <input type="text" className="form-control"  defaultValue={object.content} onChange={(e) => this.updateContent(object.id, i, e)} />
                            </div>
                        )
                    }
                });
            
        }
    }

    content()
    {
        return this.contentRow()
    }
    

    render() {

        if(this.state.doneUpdate){
            return (<Redirect to="/app" />);
        }

        return (
            <div className="container">
                <div className="row">
                    <div className="col-md-8 col-md-offset-2">
                        <div className="panel panel-default">
                            <div className="panel-heading">
                                {this.state.title}
                                </div>

                            <div className="panel-body">
                                <form>
                                    <div className="form-group">
                                        <input type="text" className="form-control" placeholder="Change Title" onChange={this.updateTitle} />
                                    </div>
                                    <hr />
                                    {this.content()}
                                    <button className="btn btn-default" type="submit" onClick={this.handleSubmit}>Save</button>
                                </form>    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}
