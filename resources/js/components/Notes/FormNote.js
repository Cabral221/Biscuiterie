import React from 'react'

class FormNote extends React.Component {
    
    constructor(props) {
        super(props)

        this.state = {
            id: this.props.id,
            note: this.props.note,
            position : this.props.position,
            dividente : this.props.dividente
        }
        
        // this.handleBlur = this.handleBlur.bind(this)
        this.handleChange = this.handleChange.bind(this)
        this.handleKeyPress = this.handleKeyPress.bind(this)
    }

    handleChange (e) {
        this.setState({
            note: e.target.value
        })
    }

    handleKeyPress (e) {
        e.preventDefault()
        if(e.keyCode === 13 && e.key === 'Enter') {
            this.props.submit(this.state.id, this.state.note, this.state.position)
        }
    }

    render () {

        const style = {
            maxWidth: 60 + "px"
        }

        return (<form ection="#" method="post" onSubmit={this.handleKeyPress}>
            <input type="number" name="note" step="0.05" min="0" max={this.state.dividente} required autoFocus={true} 
                value={this.state.note} 
                onChange={this.handleChange}
                // onBlur={this.handleBlur}
                onKeyUp={this.handleKeyPress}
                style={style} /> / {this.state.dividente}
        </form>)
    }
}

export default FormNote;
