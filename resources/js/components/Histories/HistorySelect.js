import React from 'react'

class HistorySelect extends React.Component
{
    constructor (props){
        super(props)

        this.state = {
            periods: []
        }
        this.handleSelectChange = this.handleSelectChange.bind(this)
    }

    componentDidMount() {
        this.loadPeriod()
    }

    loadPeriod() {
        const date = new Date()
        var  periods = []
        for (let index = 0; index < 10; index++) {
            var key = parseInt( date.getFullYear() - index)
            var value = ((date.getFullYear() - 1) - index) + ' - ' + (date.getFullYear() - index)
            // periods[key] = value;
            periods.push({key, value})
        }

        this.setState({ periods })
    }

    handleSelectChange(e) {
        this.props.onSelectChange(e.target.value)
    }

    render() {
        const {period} = this.props
        const {periods} = this.state

        return <form action="#" method="POST">
            <div className="form-group">
                <label htmlFor="range" className="mr-4"><h4>Selection l'année scolaire</h4></label>
                <select name="year" defaultValue={period} onChange={this.handleSelectChange}>
                    {periods.map((p, index) => (
                        <option key={index} value={p.key}>{p.value}</option>
                    ))}
                </select>
            </div>
        </form>
    }
}

export default HistorySelect;