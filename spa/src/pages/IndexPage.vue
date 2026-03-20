<template>
  <q-page class="q-pa-md">
    <div class="row q-col-gutter-md justify-center">
      <div class="col-12 col-md-4">
        <q-card flat bordered>
          <q-card-section>
            <div class="text-h6 text-primary">{{ editando ? 'Editar Produto' : 'Novo Produto' }}</div>
          </q-card-section>

          <q-card-section class="q-gutter-md">
            <q-input v-model="form.nome" label="Nome" filled />
            <q-input v-model="form.descricao" label="Descrição" filled type="textarea" />
            <q-input v-model.number="form.preco" label="Preço" filled type="number" prefix="R$" />
            <q-input v-model.number="form.quantidade" label="Estoque" filled type="number" />
          </q-card-section>

          <q-card-actions align="right">
            <q-btn label="Salvar" color="primary" @click="salvarProduto" :loading="carregando" />
          </q-card-actions>
        </q-card>
      </div>

      <div class="col-12 col-md-8">
        <q-table
          title="Produtos Cadastrados"
          :rows="produtos"
          :columns="colunas"
          row-key="id"
          flat
          bordered
        >
          <template v-slot:body-cell-preco="props">
            <q-td :props="props">
              R$ {{ props.value ? Number(props.value).toFixed(2) : '0.00' }}
            </q-td>
          </template>

          <template v-slot:body-cell-acoes="props">
            <q-td :props="props" class="q-gutter-x-sm">
              <q-btn flat round color="primary" icon="edit" size="sm" @click="prepararEdicao(props.row)" />
              
              <q-btn flat round color="negative" icon="delete" size="sm" @click="excluirProduto(props.row.id)" />
            </q-td>
          </template>
        </q-table>
      </div>
    </div>
  </q-page>
</template>

<script setup>
import { ref, reactive, onMounted } from 'vue'
import { api } from 'boot/axios'
import { useQuasar } from 'quasar'

const $q = useQuasar()
const carregando = ref(false)
const produtos = ref([])

const editando = ref(false)
const idAtual = ref(null)

// Definição das colunas da tabela
const colunas = [
  { name: 'id', label: 'ID', field: 'id', align: 'left', sortable: true },
  { name: 'nome', label: 'Nome', field: 'nome', align: 'left', sortable: true },
  { name: 'descricao', label: 'Descrição', field: 'descricao', align: 'left' },
  { name: 'preco', label: 'Preço', field: 'preco', align: 'center' },
  { name: 'quantidade', label: 'Qtd', field: 'quantidade', align: 'center' },
  { name: 'acoes', label: 'Ações', field: 'acoes', align: 'center' }
]

const form = reactive({
  nome: '',
  descricao: '',
  preco: 0,
  quantidade: 0
})

const limparForm = () => {
  form.nome = ''
  form.descricao = ''
  form.preco = 0
  form.quantidade = 0
}

// Função para buscar produtos do Laravel
const listarProdutos = async () => {
  try {
    const response = await api.get('/products')
    produtos.value = response.data
  } catch {
    $q.notify({ color: 'negative', message: 'Erro ao carregar lista.' })
  }
}

const salvarProduto = async () => {
  carregando.value = true
  try {
    if (editando.value) {
      // Rota de UPDATE: /api/products/{id}
      await api.put(`/products/${idAtual.value}`, form)
      $q.notify({ color: 'positive', message: 'Produto atualizado!' })
    } else {
      // Rota de CREATE
      await api.post('/products', form)
      $q.notify({ color: 'positive', message: 'Produto salvo!' })
    }
    
    cancelarEdicao()
    await listarProdutos()
  } catch {
    $q.notify({ color: 'negative', message: 'Erro ao processar.' })
  } finally {
    carregando.value = false
  }
}

const prepararEdicao = (produto) => {
  form.nome = produto.nome
  form.descricao = produto.descricao
  form.preco = produto.preco
  form.quantidade = produto.quantidade
  
  idAtual.value = produto.id
  editando.value = true
}

const cancelarEdicao = () => {
  limparForm()
  editando.value = false
  idAtual.value = null
}

const excluirProduto = (id) => {
  $q.dialog({
    title: 'Confirmar',
    message: 'Deseja realmente excluir este produto?',
    cancel: true,
    persistent: true
  }).onOk(async () => {
    try {
      await api.delete(`/products/${id}`)
      $q.notify({ color: 'positive', message: 'Produto excluído!' })
      listarProdutos() // Atualiza a tabela após excluir
    } catch {
      $q.notify({ color: 'negative', message: 'Erro ao excluir produto.' })
    }
  })
}

// Carrega os produtos assim que a página abre
onMounted(() => {
  listarProdutos()
})
</script>