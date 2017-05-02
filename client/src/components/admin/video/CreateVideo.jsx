import React from 'react';
import { connect } from 'react-redux';
import PropTypes from 'prop-types';
import TextField from 'material-ui/TextField';
import RaisedButton from 'material-ui/RaisedButton';
import SelectField from 'material-ui/SelectField';
import MenuItem from 'material-ui/MenuItem';
import Toggle from 'material-ui/Toggle';

import { uploadDocumentRequest } from '../../../actions/mediaActions';

import Validator from 'validator';
import isEmpty from 'lodash/isEmpty';

function validateInputEvent(data){
    let errors = {};

    if(Validator.isEmpty(data.title)){
        errors.title = 'Este campo es obligatorio'
    }
    if(Validator.isEmpty(data.content)){
        errors.content = 'Este campo es obligatorio'
    }

    if(Validator.isEmpty(data.sector)){
        errors.sector = 'Este campo es obligatorio'
    }
    if(data.media === 0){
        errors.media = 'Debes subir una imágen'
    }

    return {
        errors,
        isValid: isEmpty(errors)
    };
}

class CreateVideo extends React.Component{

    constructor(props){
        super(props);
        this.state = {
            title: '',
            content: '',
            mediaImage: {
                id: 0,
                mediaName: '',
                mediaMessage: 'Subir imágen'
            },
            imageLoading: false,
            mediaVideo: {
                id: 0,
                mediaName: '',
                mediaMessage: 'Subir video'
            },
            videoLoading: false,
            sector: '',
            requireLogin: true,
            active: true,
            errors: {},
            isLoading: false
        };
        this.style = {
            text100with: {
                width: "100%"
            },
            uploadBlock: {
                width: '45%',
                float: 'left'
            }
        }
    }

    isValid(){
        const { errors, isValid } = validateInputEvent(this.state);

        if(!isValid){
            this.setState({ errors: errors })
        }

        return isValid;
    }

    onChange(event){
        if(!event.target.name){
            console.log('noName');
        }else{
            this.setState({ [event.target.name]: event.target.value });
        }
    }

    handleImageUpload(event) {
        this.setState({
            imageLoading: true
        });
        this.props.uploadDocumentRequest(event.target.files[0]).then(result => {
            if(!result.data.error){
                this.setState({
                    mediaImage: {
                        mediaMessage: result.data.uploadFile.message,
                        mediaName: result.data.uploadFile.name,
                        id: result.data.media.id
                    }
                })
            }else{
                this.setState({
                    mediaImage: {
                        mediaMessage: result.data.uploadFile.message,
                        id: 0,
                        mediaName: ''
                    }
                })
            }
            this.setState({
                imageLoading: false
            });
        });
    }
    handleVideoUpload(event) {
        this.setState({
            imageLoading: true
        });
        this.props.uploadDocumentRequest(event.target.files[0]).then(result => {
            if(!result.data.error){
                this.setState({
                    mediaVideo: {
                        mediaMessage: result.data.uploadFile.message,
                        mediaName: result.data.uploadFile.name,
                        id: result.data.media.id
                    }
                })
            }else{
                this.setState({
                    mediaVideo: {
                        mediaMessage: result.data.uploadFile.message,
                        id: 0,
                        mediaName: ''
                    }
                })
            }
            this.setState({
                imageLoading: false
            });
        });
    }

    onChangeCategory(event, index, value){
        this.setState({
            sector: value
        })
    }

    onToggleActive(event, toggle){
        this.setState({
            active: toggle
        });
    }

    onSubmit(event){
        event.preventDefault();
        let This = this;
        if(This.isValid()){
            this.setState({ errors: {}, isLoading: true });
            console.log(this.state);
            /*this.props.createArticle(this.state).then(
                () => {
                    This.context.router.push('/admin/home');
                },
                (err) => this.setState({ errors: err.response, isLoading: false })
            );*/
        }
    }

    render(){
        const { errors, isLoading } = this.state;
        return(
            <div>
                <div className="page">
                    <h2>Agregar Video</h2>
                    <form onSubmit={this.onSubmit.bind(this)}>
                        <TextField
                            name="title"
                            floatingLabelText="Título del Video *"
                            value={this.state.title}
                            errorText={errors.title}
                            style={this.style.text100with}
                            onChange={this.onChange.bind(this)}
                        />
                        <div style={this.style.uploadBlock}>
                            <h3>Seleccionar imágen</h3>
                            <input type="file" onChange={this.handleImageUpload.bind(this)}/><br/>
                            <figure>
                                {this.state.imageLoading ? (
                                    <div>
                                        Cargando imágen...
                                    </div>
                                ):(<div></div>)}
                                <div>{this.state.mediaImage.mediaMessage}</div>
                                {this.state.mediaImage.id !== 0 ? (
                                    <img
                                        src={"http://localhost:8080/images/"+this.state.mediaImage.mediaName}
                                        style={ { width: 200 } }
                                    />
                                ):(<div></div>)}
                            </figure>
                        </div>
                        <div style={this.style.uploadBlock}>
                            <h3>Seleccionar imágen</h3>
                            <input type="file" onChange={this.handleImageUpload.bind(this)}/><br/>
                            <figure>
                                {this.state.videoLoading ? (
                                    <div>
                                        Cargando video...
                                    </div>
                                ):(<div></div>)}
                                <div>{this.state.mediaVideo.mediaMessage}</div>
                                {this.state.mediaVideo.id !== 0 ? (
                                    <video style={ { width: 200 } }>
                                        <source src={"http://localhost:8080/videos/"+this.state.mediaVideo.mediaName} type="video/mp4"/>
                                    </video>
                                ):(<div></div>)}
                            </figure>
                        </div>
                        <SelectField
                            name="category"
                            floatingLabelText="Selecciona la categoría"
                            style={this.style.text100with}
                            value={this.state.sector}
                            errorText={errors.sector}
                            onChange={this.onChangeCategory.bind(this)}
                        >
                            <MenuItem value="salud" primaryText="SECTOR SALUD" />
                            <MenuItem value="turismo" primaryText="TURISMO" />
                        </SelectField>
                        <Toggle
                            label="¿Video activo?"
                            labelPosition="right"
                            defaultToggled={this.state.active}
                            onToggle={this.onToggleActive.bind(this)}
                        />
                        <Toggle
                            label="¿Requiere Login?"
                            labelPosition="right"
                            defaultToggled={this.state.active}
                            onToggle={this.onToggleActive.bind(this)}
                        /><br/>
                        <RaisedButton
                            label="Ingresar Video"
                            type="submit"
                            disabled={isLoading}
                        />
                    </form>
                </div>
            </div>
        )
    }
}

CreateVideo.PropTypes = {
    uploadDocumentRequest: PropTypes.func.isRequired
    //createArticle: React.PropTypes.func.isRequired
};

CreateVideo.contextTypes = {
    router: PropTypes.object.isRequired
};

export default connect(null, { uploadDocumentRequest })(CreateVideo);