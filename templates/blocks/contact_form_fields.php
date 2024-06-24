<?php
/**
 * @var ?string $contactName
 * @var ?string $contactPhone
 */

$contactName ??= '';
$contactPhone ??= '';
?>

<div>
    <label for="contactName">Имя: </label>
    <input 
        type="text"
        placeholder="Name"
        name="contactName"
        value="<?= htmlspecialchars($contactName) ?>"
        required
    >
</div>

<div>
    <label for="contactPhone">Телефон: </label>
    <input 
        type="tel"
        placeholder="xxx-xxx-xx-xx"
        name="contactPhone"
        value="<?= htmlspecialchars($contactPhone) ?>"
        pattern="[0-9]{3}-[0-9]{3}-[0-9]{2}-[0-9]{2}"
        title="xxx-xxx-xx-xx"
        required
    >
</div>
