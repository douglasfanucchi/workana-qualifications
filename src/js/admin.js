const { registerBlockType } = wp.blocks
const { RichText } = wp.editor

import edit from './edit'

registerBlockType('fnwq/qualifications', {
    title: 'Workana Qualifications',
    category: 'widgets',
    attributes: {
        qualifications: {
            source: 'query',
            type: 'array',
            selector: 'li.qualifications-list__item',
            query: {
                clientName: {
                    type: 'string',
                    source: 'text',
                    selector: '.item__client'
                },
                text: {
                    source: 'text',
                    selector: '.item__message',
                    type: 'string',
                    default: ''
                },
                clientAvatar: {
                    source: 'attribute',
                    selector: '.item__avatar img',
                    type: 'string',
                    attribute: 'src'
                }
            },
            default: []
        }
    },
    edit,
    save(props) {
        const { qualifications } = props.attributes

        return(
            <ul className="qualifications-list">
                {qualifications.map( qualification => (
                <li className="qualifications-list__item">
                    <span className="item__avatar">
                        <figure>
                            <img src={qualification.clientAvatar} />
                        </figure>
                    </span>
                    <span className="item__client">{qualification.clientName}</span>
                    <p className="item__message">{qualification.text}</p>
                </li>
                ) )}
            </ul>
        )
    }
})