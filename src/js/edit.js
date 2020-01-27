import api from './services/api'
import QualificationList from './components/qualifications-list/index.js'

const { RichText } = wp.editor

export default function Entry(props) {
    const { attributes } = props
    const { setAttributes } = props
    function addCustomKeys(item) {
        item.clientName = item.client.name
        item.clientAvatar = item.client.avatar
    }

    function setQualifications() {
        api.get('/qualifications')
            .then( ({data: qualifications}) => {
                qualifications.forEach( addCustomKeys )
                setAttributes({qualifications})
            })
            .catch(error => console.log(error))
    }

    if( attributes.qualifications.length === 0 )
        setQualifications()

    return(
        <div className={props.className}>
            <RichText onChange={ title => setAttributes({title}) } value={ attributes.title || "Qualificações da Workana!" } />
            <QualificationList qualifications={attributes.qualifications} />
        </div>
    )
}