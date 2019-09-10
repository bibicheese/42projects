/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   main.c                                             :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: jmondino <jmondino@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/07/11 11:16:20 by jmondino          #+#    #+#             */
/*   Updated: 2019/09/10 15:59:14 by jmondino         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "minishell.h"

t_shell		*init_shell(void)
{
	t_shell	*shell;

	if ((shell = malloc(sizeof(t_shell))) == NULL)
		return (0);

	shell->error = 0;
	return (shell);
}

int		main(void)
{
	char	*line;
	char	**args;
	t_shell	*shell;

	shell = init_shell();
	prompt(shell);
	while (1)
	{
		if (get_next_line(0, &line))
		{
			args = ft_split_whitespaces(line);
			launch(args, shell);
			free(line);
			free(args);
			prompt(shell);
		}
	}
}
