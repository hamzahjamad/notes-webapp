import React from 'react';
import axios from 'axios';


export default class NoteList extends React.Component {

    constructor(props)
    {
        super(props);
        this.logOut = this.logOut.bind(this);
    }

    logOut(e)
    {
        e.preventDefault();
        axios.post('/logout')
             .then(response => {
                console.log('logged out');
                window.location.replace("/");
             })
            .catch(err => console.log(err));
    }

    render() {

            return (
                <nav className="navbar navbar-default navbar-static-top">
                <div className="container">
                    <div className="navbar-header">

                        <button type="button" className="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                            <span className="sr-only">Toggle Navigation</span>
                            <span className="icon-bar"></span>
                            <span className="icon-bar"></span>
                            <span className="icon-bar"></span>
                        </button>

                        <a className="navbar-brand" href="http://notes.test">
                            Laravel
                        </a>
                    </div>

                    <div className="collapse navbar-collapse" id="app-navbar-collapse">

                        <ul className="nav navbar-nav">
                            &nbsp;
                        </ul>

                        <ul className="nav navbar-nav navbar-right">
                                <li className="dropdown">
                                    <a href="#" className="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                        Menu <span className="caret"></span>
                                    </a>

                                    <ul className="dropdown-menu">
                                        <li>
                                            <a href="#" onClick={this.logOut}>
                                                Logout
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                        </ul>
                    </div>
                </div>
            </nav>
         );

    }
}

