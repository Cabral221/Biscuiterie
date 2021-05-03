import React from 'react';


class History extends React.Component {

    constructor(props){
        super(props)

        this.state = {
            data: [],
            error: '',
            loader: false
        }

    }

    componentDidMount(){
        // Activer loader
        this.setState({
            loader: true
        })

        window.axios.post('/admin/histories', {
            year: this.props.year,
        }).then(response => {
            console.log(response.data)

            this.setState({
                data: response.data,
                loader: false
            })
        }).catch((error) => {
            console.log(error.response)
            if (error.response.status == 400) {
                console.log('Une erreur s\'est produite')
                alert(error.response.data.mesage ? error.response.data.message : 'Une erreur s\'est produite, vueillez réessayer !')
            }
            
            this.setState({
                error: error.response.data.message,
                loader: false
            })
        })
    }

    render() {
        const data = this.state.data
        
        return (
            <div>
                {(this.state.loader) 
                ? <div className="loader"></div>
                :  <div>
                    {(this.state.error != '') 
                    ?   <p className="text-danger">{this.state.error}</p>
                    :   <table id="example1" className="table table-bordered table-striped">
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
        );
    }
}

export default History;
