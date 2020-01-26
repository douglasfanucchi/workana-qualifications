const {useState} = wp.element

const UpdateButton = () => {
    const [estado, setEstado] = useState(0)

    return <button onClick={() => setEstado(parseInt(estado)+1)}>Atualizar {estado}</button>
}

export default UpdateButton
