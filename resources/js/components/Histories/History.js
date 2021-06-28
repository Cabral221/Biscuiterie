import React from 'react';
import HistorySelect from './HistorySelect';


class History extends React.Component {

    constructor(props){
        super(props)

        this.state = {
            period: parseInt((new Date).getFullYear()),
            data: [],
            error: '',
            loader: false
        }
        this._isMounted = false;

        this.handleSelectChange = this.handleSelectChange.bind(this)
    }

    componentDidMount(){
        this._isMounted = true;
        this._isMounted && this.loadData(this.state.period)
    }

    componentWillUnmount() {
        this._isMounted = false;
    }

    handleSelectChange(period) {
        this.setState({period: parseInt(period)})
        this.loadData(parseInt(period))
    }

    async loadData(period) {
        // Activer loader
        this.setState({
            loader: true
        })

        window.axios.post('/admin/histories', {
            year: period,
        }).then(response => {
            this._isMounted && this.setState({
                data: response.data,
                error: '',
                loader: false,
            })
        }).catch((error) => {
            // console.log(error.response)
            if (error.response.status == 400) {
                console.log('Une erreur s\'est produite')
                alert(error.response.data.mesage ? error.response.data.message : 'Une erreur s\'est produite, vueillez réessayer !')
            }
            
            this._isMounted && this.setState({
                data: [],
                error: error.response.data.message,
                loader: false
            })
        })
    }

    render() {
        const {data, period} = this.state

        const styles = {
            display: 'block',
            overflowX: 'scroll',
        }
        
        return (
            <React.Fragment>
                <HistorySelect 
                    period={period} 
                    onSelectChange={this.handleSelectChange} />
                <div>
                {(this.state.loader) 
                ? <div className="loader"></div>
                :  <div style={styles}>
                    {(this.state.error != '') 
                    ?   <p className="text-danger text-center"><i className="fa fa-exclamation-circle"></i> {this.state.error}</p>
                    :   <table className="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Téléphone</th>
                                    <th>Email</th>
                                    <th>Classe</th>
                                    <th>Ajouter le</th>
                                </tr>
                            </thead>
                            <tbody>
                                {data.map((master) => {
                                    return <tr key={master.id}>
                                        <td>{master.full_name}</td>
                                        <td>{master.phone}</td>
                                        <td>{master.email}</td>
                                        <td><span className="badge badge-primary">{master.classe}</span></td>
                                        <td>{master.added_at}</td>
                                    </tr>
                                })}
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Nom</th>
                                    <th>Téléphone</th>
                                    <th>Email</th>
                                    <th>Classe</th>
                                    <th>Ajouter le</th>
                                </tr>
                            </tfoot>
                        </table>
                    } 
                </div>} 
            </div>
            </React.Fragment>
        );
    }
}

export default History;
