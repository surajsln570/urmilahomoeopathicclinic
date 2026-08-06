export default function Test({ message }) {
    return (
        <div className="text-5xl" style={{ padding: 40, fontFamily: 'sans-serif' }}>
            <h1>{message}</h1>
            <p>If you can see this, Inertia + React is working 🎉</p>
        </div>
    )
}
