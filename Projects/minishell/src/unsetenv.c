/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   unsetenv.c                                         :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: jmondino <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/09/17 15:15:33 by jmondino          #+#    #+#             */
/*   Updated: 2019/09/23 15:36:19 by jmondino         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "minishell.h"

static void		memdel_fill_struct(t_shell *shell, char **newenv)
{
	free_tab(shell->env);
	shell->env = array_cpy(newenv);
	free_tab(newenv);
	free_tab(shell->paths);
	shell->paths = paths(shell->env);
	free_tab(shell->renv);
	free_tab(shell->lenv);
	shell->renv = renv(shell->env);
	shell->lenv = lenv(shell->env);
}

static void		erase(char *arg, t_shell *shell)
{
	int		i;
	int		j;
	char	**newenv;
	char	**var;

	i = 0;
	j = 0;
	while (shell->env[i])
		i++;
	if (!(newenv = (char **)malloc(sizeof(char *) * i)))
		return ;
	i = 0;
	while (shell->env[i])
	{
		var = ft_strsplit(shell->env[i], "=");
		if (!ft_strcmp(var[0], arg))
			i++;
		else
			newenv[j++] = ft_strdup(shell->env[i++]);
		free_tab(var);
	}
	newenv[j] = NULL;
	memdel_fill_struct(shell, newenv);
}

static int		parsing(char *arg, t_shell *shell)
{
	int		i;
	char	**var;

	i = 0;
	if (!shell->env)
		return (0);
	while (shell->env[i])
	{
		var = ft_strsplit(shell->env[i], "=");
		if (!ft_strcmp(var[0], arg))
		{
			free_tab(var);
			return (1);
		}
		i++;
		free_tab(var);
	}
	return (0);
}

void			ft_unsetenv(char **args, t_shell *shell)
{
	if (!args[1] || args[2])
	{
		ft_putstr_fd("usage: unsetenv VARNAME\n", 2);
		shell->error = 1;
	}
	else
	{
		if (parsing(args[1], shell))
			erase(args[1], shell);
		else
		{
			ft_putstr_fd("unsetenv: ", 2);
			ft_putstr_fd(args[1], 2);
			ft_putstr_fd(": No such variable\n", 2);
			shell->error = 1;
		}
	}
}
