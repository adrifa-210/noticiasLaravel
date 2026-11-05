/**
 * InfoPulso - Interactividad para la Guía de Formato Markdown
 */

(function () {
    'use strict';

    /**
     * Aplica el formato Markdown indicado al textarea de destino.
     * Si hay texto seleccionado, lo formatea. Si no, inserta una plantilla con texto de ejemplo seleccionado.
     *
     * @param {string} type Tipo de formato ('bold', 'italic', 'h1', 'h2', 'link', 'list', 'quote', 'code')
     * @param {string} textareaId Identificador del elemento textarea (por defecto 'cuerpo')
     */
    function applyMarkdownFormat(type, textareaId = 'cuerpo') {
        const textarea = document.getElementById(textareaId);
        if (!textarea) return;

        const start = textarea.selectionStart;
        const end = textarea.selectionEnd;
        const fullText = textarea.value;
        const selected = fullText.substring(start, end);

        let replacement = '';
        let cursorStart = start;
        let cursorEnd = end;

        switch (type) {
            case 'bold':
                if (selected.length > 0) {
                    replacement = `**${selected}**`;
                    cursorStart = start + 2;
                    cursorEnd = end + 2;
                } else {
                    const placeholder = 'texto en negrita';
                    replacement = `**${placeholder}**`;
                    cursorStart = start + 2;
                    cursorEnd = cursorStart + placeholder.length;
                }
                break;

            case 'italic':
                if (selected.length > 0) {
                    replacement = `*${selected}*`;
                    cursorStart = start + 1;
                    cursorEnd = end + 1;
                } else {
                    const placeholder = 'texto en cursiva';
                    replacement = `*${placeholder}*`;
                    cursorStart = start + 1;
                    cursorEnd = cursorStart + placeholder.length;
                }
                break;

            case 'h1':
                if (selected.length > 0) {
                    const prefix = (start === 0 || fullText[start - 1] === '\n') ? '# ' : '\n# ';
                    replacement = `${prefix}${selected}\n`;
                    cursorStart = start + prefix.length;
                    cursorEnd = cursorStart + selected.length;
                } else {
                    const prefix = (start === 0 || fullText[start - 1] === '\n') ? '# ' : '\n# ';
                    const placeholder = 'Título principal';
                    replacement = `${prefix}${placeholder}\n`;
                    cursorStart = start + prefix.length;
                    cursorEnd = cursorStart + placeholder.length;
                }
                break;

            case 'h2':
                if (selected.length > 0) {
                    const prefix = (start === 0 || fullText[start - 1] === '\n') ? '## ' : '\n## ';
                    replacement = `${prefix}${selected}\n`;
                    cursorStart = start + prefix.length;
                    cursorEnd = cursorStart + selected.length;
                } else {
                    const prefix = (start === 0 || fullText[start - 1] === '\n') ? '## ' : '\n## ';
                    const placeholder = 'Subtítulo';
                    replacement = `${prefix}${placeholder}\n`;
                    cursorStart = start + prefix.length;
                    cursorEnd = cursorStart + placeholder.length;
                }
                break;

            case 'link':
                if (selected.length > 0) {
                    if (/^https?:\/\//i.test(selected.trim())) {
                        replacement = `[enlace](${selected.trim()})`;
                        cursorStart = start + 1;
                        cursorEnd = start + 7;
                    } else {
                        replacement = `[${selected}](https://...)`;
                        cursorStart = start + selected.length + 3;
                        cursorEnd = cursorStart + 10;
                    }
                } else {
                    const placeholder = 'texto del enlace';
                    replacement = `[${placeholder}](https://...)`;
                    cursorStart = start + 1;
                    cursorEnd = cursorStart + placeholder.length;
                }
                break;

            case 'list':
                if (selected.length > 0) {
                    const lines = selected.split('\n');
                    replacement = lines.map(line => line.startsWith('- ') ? line : `- ${line}`).join('\n');
                    cursorStart = start;
                    cursorEnd = start + replacement.length;
                } else {
                    const prefix = (start === 0 || fullText[start - 1] === '\n') ? '- ' : '\n- ';
                    const placeholder = 'Elemento de lista';
                    replacement = `${prefix}${placeholder}\n`;
                    cursorStart = start + prefix.length;
                    cursorEnd = cursorStart + placeholder.length;
                }
                break;

            case 'quote':
                if (selected.length > 0) {
                    const lines = selected.split('\n');
                    replacement = lines.map(line => line.startsWith('> ') ? line : `> ${line}`).join('\n');
                    cursorStart = start;
                    cursorEnd = start + replacement.length;
                } else {
                    const prefix = (start === 0 || fullText[start - 1] === '\n') ? '> ' : '\n> ';
                    const placeholder = 'Cita textual';
                    replacement = `${prefix}${placeholder}\n`;
                    cursorStart = start + prefix.length;
                    cursorEnd = cursorStart + placeholder.length;
                }
                break;

            case 'code':
                if (selected.length > 0) {
                    if (selected.includes('\n')) {
                        replacement = `\n\`\`\`\n${selected}\n\`\`\`\n`;
                        cursorStart = start + 4;
                        cursorEnd = cursorStart + selected.length;
                    } else {
                        replacement = `\`${selected}\``;
                        cursorStart = start + 1;
                        cursorEnd = end + 1;
                    }
                } else {
                    const placeholder = 'código';
                    replacement = `\`${placeholder}\``;
                    cursorStart = start + 1;
                    cursorEnd = cursorStart + placeholder.length;
                }
                break;

            default:
                return;
        }

        // Inserción preservando el historial de Deshacer (Undo/Redo)
        if (typeof textarea.setRangeText === 'function') {
            textarea.setRangeText(replacement, start, end, 'select');
            textarea.setSelectionRange(cursorStart, cursorEnd);
        } else {
            textarea.value = fullText.substring(0, start) + replacement + fullText.substring(end);
            textarea.setSelectionRange(cursorStart, cursorEnd);
        }

        textarea.focus();
        textarea.dispatchEvent(new Event('input', { bubbles: true }));
    }

    /**
     * Inicialización de eventos sobre los botones de la guía Markdown.
     */
    function initMarkdownButtons() {
        document.addEventListener('click', function (e) {
            const button = e.target.closest('[data-markdown-format]');
            if (!button) return;

            e.preventDefault();
            const format = button.getAttribute('data-markdown-format');
            const targetId = button.getAttribute('data-target-id') || 'cuerpo';
            applyMarkdownFormat(format, targetId);
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initMarkdownButtons);
    } else {
        initMarkdownButtons();
    }
})();

