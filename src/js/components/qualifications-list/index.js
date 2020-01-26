import QualificationItem from '../qualification-item/index.js'

export default function QualificationsList(props) {
    const { qualifications } = props

    return(
        <ul className="qualifications-list">
            {qualifications.map( qualification => (
                <QualificationItem qualification={qualification} />
            ) )}
        </ul>
    )
}
